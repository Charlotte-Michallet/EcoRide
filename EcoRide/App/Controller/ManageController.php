<?php
namespace App\Controller;

use App\Controller\Admin\CompanyContr;
use App\Controller\Auth\NotesContr;
use App\Repository\FeedbackRepository;
use App\Repository\ReservationRepository;
use App\Repository\TripRepository;
use App\Repository\UserRepository;

class ManageController extends Router
{
    public function route($meta)
    {
        try {
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {

                    case 'manageFeedbacks':
                        $this->manageFeedbacks($meta);
                        break;

                    case 'badReviews':
                        $this->badReviews($meta);
                        break;

                    default:
                        throw new \Exception("Cette action n'existe pas : " . $_GET["action"]);
                }
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch (\Exception $e) {
            $this->render("errors/default", ["error" => $e->getMessage()]);
        }
    }

    protected function manageFeedbacks($meta)
    {
        $userId = $_SESSION["id"];
        $roleid = $_SESSION["role"];

        // token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        $feedbackRepo = new FeedbackRepository();
        $feedbacks    = $feedbackRepo->validationFeedback();
        $allfeedbacks = $feedbackRepo->showAllFeedbacks();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->manageFeedbackMethod();
        }

        if ($userId && ($roleid === 2 || $roleid === 1)) {
            $this->render("employee/manageFeedback", ["token" => $currentToken, "feedbacks" => $feedbacks, "allfeedbacks" => $allfeedbacks, "meta" => $meta["manageFeedbacks"]]);
        } else {
            header("Location: /index.php");
            exit();
        }
    }

    protected function badReviews($meta)
    {
        $userId = $_SESSION["id"];
        $roleid = $_SESSION["role"];

        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        $feedbackRepo = new FeedbackRepository();
        $feedbacks    = $feedbackRepo->showbadFeedback();
        $Resolvedfeed = $feedbackRepo->allshowbadFeedback();
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->paymentMethod();
        }

        if ($userId && ($roleid === 2 || $roleid === 1)) {
            $this->render("employee/badReviews", ["token" => $currentToken, "feedbacks" => $feedbacks, "Resolvedfeeds" => $Resolvedfeed, "meta" => $meta["badReviews"]]);
        } else {
            header("Location: /index.php");
            exit();
        }
    }

    protected function paymentMethod()
    {
        $submittedToken = $_POST["token"];
        $token          = new TokenCsrf();
        $isValid        = $token->validateToken($submittedToken);

        if ($isValid) {
            $idreservationString = $_POST["idreservation"];
            $feedbackIdString    = $_POST["idfeedback"];

            $idreservation = (int) $idreservationString;
            $feedbackId    = (int) $feedbackIdString;

            if (isset($_POST["driverPayment"]) && $_POST["driverPayment"]) {

                $tripRepo       = new TripRepository();
                $tripinfo       = $tripRepo->driverIdPriceTrip($idreservation);
                $driverId       = $tripinfo["user_id"];
                $totalPriceTrip = $tripinfo["totalPrice"];

                $priceDriver = $totalPriceTrip - 2;

                $driverRepo         = new UserRepository();
                $creditsuser        = $driverRepo->usercredits($driverId);
                $updatedcreditsUser = $creditsuser + $priceDriver;

                $creditsUpdate = $driverRepo->UpdatecreditsTrip($driverId, $updatedcreditsUser);
                if ($creditsUpdate) {
                    $statusPayment     = "Validé";
                    $statusReservation = "Note enregistré";

                } else {
                    $statusPayment = "Une erreur est survenue Non validé";
                }
                $resarepo = new ReservationRepository();
                $resarepo->updateRervationpayement($idreservation, $statusPayment);
                $resarepo->updateRervationStatus($idreservation, $statusReservation);

                $feedbackrepo  = new FeedbackRepository();
                $feedbackempty = $feedbackrepo->feedbackEmpty($feedbackId);

                if ($feedbackempty === null) {
                    $statusFeedback = "Enregistré";
                } else {
                    $statusFeedback = "Payé";
                }
                $feedbackrepo->Upadatefeedback($statusFeedback, $feedbackId);

                $companyContr = new CompanyContr();
                $update       = $companyContr->updateStatusPayment($idreservation, $statusPayment);
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

            $idFeedbackString    = $_POST["idFeedback"];
            $idreservationString = $_POST["idreservation"];
            $noteFeedbackString  = $_POST["noteFeedback"];

            $idreservation = (int) $idreservationString;
            $idFeedback    = (int) $idFeedbackString;
            $noteFeedback  = (int) $noteFeedbackString;

            if (isset($_POST["refuseFeedback"]) && $_POST["refuseFeedback"]) {
                $statusReservation = "Note enregistré";
                $feedbackstatus    = "Refusé";
            }

            if (isset($_POST["validateFeedback"]) && $_POST["validateFeedback"]) {
                $statusReservation = "Note enregistré";
                $feedbackstatus    = "Validé";

                $notesContr = new NotesContr();
                $notesContr->notesAverageDriver($idreservation, $noteFeedback);
            }

            $resarepo          = new ReservationRepository();
            $reservationStatus = $resarepo->updateRervationStatus($idreservation, $statusReservation);

            $feedbackRepo   = new FeedbackRepository();
            $statusFeedback = $feedbackRepo->Upadatefeedback($feedbackstatus, $idFeedback);

            if ($reservationStatus && $statusFeedback) {
                header("Location: /index.php?controller=manage&action=manageFeedbacks");
            } else {
                echo "Une erreur est survenue";
            }
        }
    }
}
