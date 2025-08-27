<?php
namespace App\Controller;

use Admin\App\Controller\CompanyContr;
use App\Controller\Employee\ManageFeedbacksContr;
use App\Repository\FeedbackRepository;
use App\Repository\ReservationRepository;
use App\Repository\TripRepository;
use App\Repository\UserRepository;

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

                    case 'badReviews':
                        $this->badReviews();
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
    protected function badReviews()
    {
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        $feedbackRepo = new FeedbackRepository();
        $feedbacks    = $feedbackRepo->showbadFeedback();
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->paymentMethod();
        }

        $this->render("employee/badReviews", ["token" => $currentToken, "feedbacks" => $feedbacks]);
    }
    protected function paymentMethod()
    {
        $submittedToken = $_POST["token"];
        $token          = new TokenCsrf();
        $isValid        = $token->validateToken($submittedToken);

        if ($isValid) {
            $idreservationString = $_POST["idreservation"];
            $idreservation       = (int) $idreservationString;

            if (isset($_POST["driverPayment"]) && $_POST["driverPayment"]) {

                $tripRepo       = new TripRepository();
                $tripinfo       = $tripRepo->driverIdPriceTrip($idreservation);
                $driverId       = $tripinfo["user_id"];
                $totalPriceTrip = $tripinfo["totalPrice"];
                $priceDriver    = $totalPriceTrip - 2;

                $driverRepo         = new UserRepository();
                $creditsuser        = $driverRepo->usercredits($driverId);
                $updatedcreditsUser = $creditsuser + $priceDriver;

                $creditsUpdate = $driverRepo->UpdatecreditsTrip($driverId, $updatedcreditsUser);
                if ($creditsUpdate) {
                    $statusPayment = "Validé";
                } else {
                    $statusPayment = "Une erreur est survenue Non validé";
                }
                $resarepo = new ReservationRepository();
                $resarepo->updateRervationpayement($idreservation, $statusPayment);

                $companyContr = new CompanyContr();
                $companyContr->updateCreditsCompany();
                $update = $companyContr->updateStatusPayment($idreservation, $statusPayment);
                if ($update) {
                    $errors = ["La mise à jour du recu na pas marche"];
                    return $errors;
                } else {
                    header("Location: /index.php?controller=manage&action=manageFeedbacks");
                }
            }
        }
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
