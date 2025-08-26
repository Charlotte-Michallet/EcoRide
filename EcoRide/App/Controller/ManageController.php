<?php
namespace App\Controller;

use App\Controller\Employee\ManageFeedbacksContr;
use App\Repository\FeedbackRepository;

class ManageController extends Router
{
    public function route()
    {
        try {
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {

                    case 'manageFeedbacks':
                        $this->manageFeedbacks();
                        break;

                    default:
                        throw new \Exception("Cette action n'existe pas" . $_GET["action"]);
                }
            } else {
                // home page
            }
        } catch (\Exception $e) {
            $this->render("errors/default", ["error" => $e->getMessage()]);
        }
    }

    protected function manageFeedbacks()
    {
        // token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        $feedbackRepo = new FeedbackRepository();
        $feedbacks    = $feedbackRepo->showAllFeedback();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->manageFeedbackMethod();
        }

        $this->render("employee/manageFeedback", ["token" => $currentToken, "feedbacks" => $feedbacks]);
    }

    protected function manageFeedbackMethod()
    {
        $submittedToken = $_POST["token"];
        $token          = new TokenCsrf();
        $isValid        = $token->validateToken($submittedToken);

        if ($isValid) {
            $feedbackidString      = $_POST["idFeedback"];
            $idreservationidstring = $_POST["idreservation"];
            //                 $numSeatsBookesString = $_GET["refuseFeedback"];
            //                 $creditsUsedString    = $_POST["creditsUsed"];
            $carSharingIdString = $_POST["idcarsharing"];

            $feedbackid      = (int) $feedbackidString;
            $idreservationid = (int) $idreservationidstring;
            $carSharingId    = (int) $carSharingIdString;

            if (isset($_POST["refuseFeedback"]) && $_POST["refuseFeedback"]) {
                $statusfeedback    = "Refusé";
                $statusreservation = "L'avis est refusé";
                $paymentStatus     = "Payement Refusé en attente de contact";
                $manageContr       = new ManageFeedbacksContr();
                $manageContr->manageFeedback($statusfeedback, $feedbackid, $idreservationid, $statusreservation, $paymentStatus);
            }

            // if (isset($_POST["refuseFeedback"]) && $_POST["refuseFeedback"]) {
            //     # code...
            // }

            header("Location: /index.php?controller=manage&action=manageFeedbacks");
        }
    }
}
