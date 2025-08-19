<?php
namespace App\Controller;

use App\Repository\CarRepository;
use App\Repository\ReservationRepository;
use App\Repository\TripRepository;
use App\Repository\UserRepository;

class TripsController extends Router
{
    public function route()
    {
        try {
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case 'createTrip':
                        $this->createTrip();
                        break;

                    case 'manageTrip':
                        $this->manageTrip();
                        break;

                    case 'history':
                        $this->history();
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

    // Methods for redirecting pages
    protected function createTrip()
    {

        $userId = $_SESSION["id"];
        $roleid = $_SESSION["role"];

        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        if ($userId && ($roleid === 3 || $roleid === 5)) {
            // generate token CSRF
            $carRepo  = new CarRepository();
            $carsInfo = $carRepo->showUserCars($userId);
        }
        // show page
        $this->render("userTrips/createTrip", ["token" => $currentToken, "cars" => $carsInfo]);
    }

    protected function manageTrip()
    {

        $user_id  = $_SESSION["id"];
        $tripRepo = new TripRepository();
        $trips    = $tripRepo->showTripManage($user_id);

        $this->deleteMethod();
        $this->UpdateStartMethod();
        $this->UpdateEndMethod();
        $this->deletereservation();

        // generate token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        $reservaRepo = new ReservationRepository();
        $reservation = $reservaRepo->ReservaManage($user_id);

        // show page
        $this->render("userTrips/manageTrips", ["token" => $currentToken, "trips" => $trips, "reservations" => $reservation]);
    }

    protected function history()
    {
        $user_id = $_SESSION["id"];
        // generate token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        $tripRepo = new TripRepository();
        $trips    = $tripRepo->showTripHistory($user_id);

        $reservaRepo = new ReservationRepository();
        $reservation = $reservaRepo->showReservationHistory($user_id);

        // show page
        $this->render("userTrips/history", ["token" => $currentToken, "trips" => $trips, "reservations" => $reservation]);
    }

    protected function deleteMethod()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && (isset($_POST["idDelete"]) && $_POST["idDelete"])) {
            // get data from form
            $submittedToken = htmlspecialchars($_POST["tokenDelete"]);
            $id             = htmlspecialchars(trim($_POST["idTrip"]));

            // Check token CSRF
            $token   = new TokenCsrf();
            $isValid = $token->validateToken($submittedToken);

            if ($isValid) {
                $tripRepo = new TripRepository();
                $tripRepo->deleteTrip($id);
            }
        }
    }

    protected function UpdateStartMethod()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && (isset($_POST["idStart"]) && $_POST["idStart"])) {
            // get data from form
            $submittedToken = htmlspecialchars($_POST["tokenStart"]);
            $id             = htmlspecialchars(trim($_POST["idTripStart"]));
            $status         = "Démarrer";

            // Check token CSRF
            $token   = new TokenCsrf();
            $isValid = $token->validateToken($submittedToken);

            if ($isValid) {
                $tripRepo = new TripRepository();
                $tripRepo->updatetTrip($status, $id);
            }
        }
    }

    protected function UpdateEndMethod()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && (isset($_POST["endSubmit"]) && $_POST["endSubmit"])) {
            // get data from form
            $submittedToken = htmlspecialchars($_POST["tokenEnd"]);
            $id             = htmlspecialchars(trim($_POST["idTripEnd"]));
            $status         = "Arrivée à destination";

            // Check token CSRF
            $token   = new TokenCsrf();
            $isValid = $token->validateToken($submittedToken);

            if ($isValid) {
                $tripRepo = new TripRepository();
                $tripRepo->updatetTrip($status, $id);
            }
        }
    }

    protected function deletereservation()
    {
        $user_id = $_SESSION["id"];

        if (isset($user_id)) {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                if (isset($_POST["deleteReservation"]) && $_POST["deleteReservation"]) {

                    $submittedToken = $_POST["tokenDeleteReserva"];

                    $token   = new TokenCsrf();
                    $isValid = $token->validateToken($submittedToken);

                    if ($isValid) {
                        $idReservationString    = $_POST["idReservation"];
                        $seatsReservationString = $_POST["seatsReserved"];
                        $idcarsharingString     = $_POST["idCarSharing"];
                        $creditsString          = $_POST["credits"];
                        $carSharingStatusString = $_POST["carSharingStatus"];

                        $idReservation    = (int) $idReservationString;
                        $seatsReservation = (int) $seatsReservationString;
                        $idcarsharing     = (int) $idcarsharingString;
                        $credits          = (int) $creditsString;
                        $carSharingStatus = (int) $carSharingStatusString;

                        $revervaRepo = new ReservationRepository();
                        $delete      = $revervaRepo->deleteTrip($idReservation);

                        if ($delete === true) {
                            $tripRep      = new TripRepository();
                            $seats        = $tripRep->seeSeatsTrip($idcarsharing);
                            $seatsUpadate = $seats + $seatsReservation;
                            $update       = $tripRep->updatetSeatsTrip($seatsUpadate, $idcarsharing);

                            if (! empty($update)) {
                                var_dump("yes");
                                $userRepo          = new UserRepository();
                                $creditsuser       = $userRepo->usercredits($user_id);
                                $updateCredits     = $creditsuser + $credits;
                                $updateUserCredits = $userRepo->UpdatecreditsTrip($user_id, $updateCredits);

                                if (empty($updateUserCredits)) {
                                    var_dump("erreur");
                                }
                            }

                        } else {
                            var_dump("erreur");
                        }
                    }
                }
            }
        }
    }
}
