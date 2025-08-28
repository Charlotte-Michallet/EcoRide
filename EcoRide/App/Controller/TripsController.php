<?php
namespace App\Controller;

use Admin\App\Controller\CompanyContr;
use App\Controller\Mail\MailerContr;
use App\Controller\Mail\SendMailContr;
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

        if ($userId && $roleid !== 4) {
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

        $this->deleteCarSharingMethod();
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

    protected function deleteCarSharingMethod()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && (isset($_POST["idDelete"]) && $_POST["idDelete"])) {
            // get data from form
            $submittedToken = htmlspecialchars($_POST["tokenDelete"]);
            $id             = htmlspecialchars(trim($_POST["idTrip"]));
            $dateTrip       = htmlspecialchars(trim($_POST["dateTrip"]));
            $departureTrip  = htmlspecialchars(trim($_POST["departureTrip"]));
            $arrivalTrip    = htmlspecialchars(trim($_POST["arrivalTrip"]));

            // Check token CSRF
            $token   = new TokenCsrf();
            $isValid = $token->validateToken($submittedToken);

            if ($isValid) {
                $reservationRepo = new ReservationRepository();
                $passengerRepo   = new UserRepository();
                $driverName      = $_SESSION["username"];

                // trouver les id de resa idpassager userna email
                $passengersInfo = $reservationRepo->reservationIdPassengersInfo($id);
                foreach ($passengersInfo as $passengerInfo) {

                    $reservationId = $passengerInfo["reservation_id"];
                    $passagerId    = $passengerInfo["user_id"];
                    $username      = $passengerInfo["username"];
                    $email         = $passengerInfo["email"];
                    $totalPrice    = $passengerInfo["totalPrice"];

                    // Enlever les 2 credit de lentreprise
                    $companyContr = new CompanyContr();
                    $companyContr->cancelCreditsCompany();

                    // supprimer transaction
                    $idTransation = $reservationRepo->selectTransaction($reservationId);
                    $companyContr->deleteJurnalTrip($idTransation);

                    // Rembourser les passager
                    $passengersCredits      = $passengerRepo->usercredits($passagerId);
                    $creditsForPassenger    = $totalPrice - 2;
                    $passengeCreditsUpdated = $creditsForPassenger + $passengersCredits;
                    $passengerRepo->UpdatecreditsTrip($passagerId, $passengeCreditsUpdated);

                    // envoie mail
                    $mailControl = new MailerContr();
                    $mailControl->sendMailPassenger($email, $username, $driverName, $dateTrip, $departureTrip, $arrivalTrip);

                }
                // supprimer covoiturage a la fin
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

                $sendmailContr = new SendMailContr();
                $result        = $sendmailContr->sendMail($id);

                if ($result === "Email demande avis envoyé") {
                    $_SESSION["feedback"] = true;
                } else {
                    $_SESSION["feedback"] = false;
                }

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

                        $idReservation    = (int) $idReservationString;
                        $seatsReservation = (int) $seatsReservationString;
                        $idcarsharing     = (int) $idcarsharingString;
                        $credits          = (int) $creditsString;

                        $revervaRepo   = new ReservationRepository();
                        $idtransaction = $revervaRepo->selectTransaction($idReservation);

                        $delete = $revervaRepo->deleteTrip($idReservation);

                        if ($delete === true) {
                            $tripRep      = new TripRepository();
                            $seats        = $tripRep->seeSeatsTrip($idcarsharing);
                            $seatsUpadate = $seats + $seatsReservation;
                            $update       = $tripRep->updatetSeatsTrip($seatsUpadate, $idcarsharing);

                            if (! empty($update)) {
                                $userRepo          = new UserRepository();
                                $creditsuser       = $userRepo->usercredits($user_id);
                                $updateCredits     = $creditsuser + $credits;
                                $updateUserCredits = $userRepo->UpdatecreditsTrip($user_id, $updateCredits);

                                if (! empty($updateUserCredits)) {
                                    $companyContr = new CompanyContr();
                                    $companyContr->cancelCreditsCompany();
                                    $companyContr->deleteJurnalCredits($idtransaction);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
