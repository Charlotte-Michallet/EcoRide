<?php
namespace App\Controller;

use App\Controller\CarSharing\DetailsContr;
use App\Controller\CarSharing\ReservationContr;
use App\Repository\FeedbackRepository;
use App\Repository\ReservationRepository;
use App\Repository\TripRepository;

class CarSharingController extends Router
{
    public function route($meta)
    {
        try {
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case 'show':
                        $this->show($meta);
                        break;

                    case 'details':
                        $this->details($meta);
                        break;

                    case 'feedbacks':
                        $this->feedbacks($meta);
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

    protected function show($meta)
    {
        // generate token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        $this->render("carSharing/showItinerary", ["token" => $currentToken, "meta" => $meta["showItinerary"]]);
    }

    protected function details($meta)
    {
        // generate token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        $id = $_GET["id"];

        $detailsRepo   = new TripRepository();
        $details       = $detailsRepo->detailsTrips($id);
        $detailsCont   = new DetailsContr();
        $othersdetails = $detailsCont->details($id);

        $userId       = $details->getDriverId();
        $feedbackRepo = new FeedbackRepository();
        $feedbacks    = $feedbackRepo->showFeedbackTrips($userId);

        $credits = $details->getPrice();

        $numSeatsBookesString = $_GET["seats"];
        $numSeatsBookes       = (int) $numSeatsBookesString;

        $creditsTotal = $numSeatsBookes * $credits;

        $this->particiateTrip();

        $this->render("carSharing/detailsCarSharing", ["token" => $currentToken, "details" => $details, "moreDetails" => $othersdetails, "totalPrice" => $creditsTotal, "feedbacks" => $feedbacks, "meta" => $meta["details"]]);

    }

    protected function feedbacks($meta)
    {
        $userId = $_SESSION["id"];

        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        $idreservation = $_GET["reservation"];

        $reservaRepo = new ReservationRepository();
        $reservaInfo = $reservaRepo->showReservation($idreservation);

        if ($userId) {
            $this->render("carSharing/feedbacks", ["token" => $currentToken, "reservation" => $reservaInfo, "meta" => $meta["feedback"]]);
        } else {
            header("Location: /index.php");
        }
    }

    protected function particiateTrip()
    {
        $id = $_GET["id"];

        if (isset($id)) {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                if (isset($_POST["participateBtn"]) && $_POST["participateBtn"]) {

                    $submittedToken = $_POST["token_Participate"];
                    $token          = new TokenCsrf();
                    $isValid        = $token->validateToken($submittedToken);

                    if ($isValid) {
                        $carSharingIdString   = $_POST["car_sharing_id"];
                        $userId               = $_SESSION["id"];
                        $reservationDate      = $_POST["reservation_date"];
                        $numSeatsBookesString = $_GET["seats"];
                        $creditsUsedString    = $_POST["creditsUsed"];
                        $paymentStatus        = "en attente";
                        $status               = "enregistrée";

                        $carSharingId   = (int) $carSharingIdString;
                        $numSeatsBookes = (int) $numSeatsBookesString;
                        $creditsUsed    = (int) $creditsUsedString;

                        $reserContr  = new ReservationContr();
                        $reservation = $reserContr->reservation($carSharingId, $userId, $reservationDate, $numSeatsBookes, $paymentStatus, $status, $creditsUsed);
                        if (! empty($reservation)) {
                            echo $reservation["error"];
                        }
                    }
                }
            }
        }
    }
}
