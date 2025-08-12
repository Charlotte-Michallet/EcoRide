<?php
namespace App\Controller;

use App\Repository\CarRepository;
use App\Repository\TripRepository;

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

        // generate token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        // show page
        $this->render("userTrips/manageTrips", ["token" => $currentToken, "trips" => $trips]);
    }

    protected function history()
    {
        $user_id = $_SESSION["id"];
        // generate token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        $tripRepo = new TripRepository();
        $trips    = $tripRepo->showTripHistory($user_id);

        // show page
        $this->render("userTrips/history", ["token" => $currentToken, "trips" => $trips]);
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
}
