<?php
namespace App\Controller;

use App\Repository\CarRepository;

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

        $userId       = $_SESSION["id"];
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        if ($userId) {
            // generate token CSRF
            $carRepo  = new CarRepository();
            $carsInfo = $carRepo->showUserCars($userId);
        }
        // show page
        $this->render("userTrips/createTrip", ["token" => $currentToken, "cars" => $carsInfo]);
    }

    protected function manageTrip()
    {
        // generate token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        // show page
        $this->render("userTrips/manageTrips", ["token" => $currentToken]);
    }

    protected function history()
    {
        // generate token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        // show page
        $this->render("userTrips/history", ["token" => $currentToken]);
    }
}
