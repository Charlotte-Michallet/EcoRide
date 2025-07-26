<?php
namespace App\Controller;

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
        // generate token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        // show page
        $this->render("userTrips/createTrip", ["token" => $currentToken]);
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
