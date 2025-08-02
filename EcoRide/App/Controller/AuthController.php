<?php
namespace App\Controller;

use App\Controller\Auth\ProfilContr;
use App\Repository\CarRepository;
use App\Repository\UserRepository;

class AuthController extends Router
{
    public function route()
    {
        try {
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case 'login':
                        $this->login();
                        break;

                    case 'register':
                        $this->register();
                        break;

                    case 'profil':
                        $this->profil();
                        break;

                    case 'profilModify':
                        $this->profilModify();
                        break;

                    case 'cars':
                        $this->cars();
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
    protected function login()
    {
        // generate token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        // show page
        $this->render("auth/login", ["token" => $currentToken]);
    }

    protected function register()
    {
        // generate token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        // show page
        $this->render("auth/register", ["token" => $currentToken]);
    }

    protected function profil()
    {
        $userId = $_SESSION["id"];

        if ($userId) {
            $tokenObj     = new TokenCsrf();
            $currentToken = $tokenObj->getGenerateToken();

            $userRepo = new UserRepository();
            $user     = $userRepo->userInfo($userId);

            $license = $user->isDriversLicense();

            if ($license === false) {
                $license = "Non";

            } elseif ($license === true) {
                $license = "Oui";

            } else {
                $license = "Non renseigné";
            }

            $profilContr = new ProfilContr();
            $preferences = $profilContr->Preferences($userId);

            $this->render("auth/profil", ["token" => $currentToken, "user" => $user, "license" => $license, "preferences" => $preferences]);

            $this->deleteUserMethod();
        }
    }

    protected function profilModify()
    {
        $userId = $_SESSION["id"];

        if ($userId) {

            $userRepo = new UserRepository();
            $user     = $userRepo->userInfo($userId);

            $tokenObj     = new TokenCsrf();
            $currentToken = $tokenObj->getGenerateToken();

            // show page
            $this->render("auth/modifyProfil", ["user" => $user, "token" => $currentToken]);
        }
    }

    protected function cars()
    {
        $user_id = $_SESSION["id"];

        if ($user_id) {
            // generate token CSRF
            $tokenObj     = new TokenCsrf();
            $currentToken = $tokenObj->getGenerateToken();

            $carRepo  = new CarRepository();
            $carsInfo = $carRepo->showUserCars($user_id);

            $this->deleteCarMethod();

            // // show page
            $this->render("userTrips/userCars", ["token" => $currentToken, "cars" => $carsInfo]);
        }
    }

    // Methods for getting data

    protected function deleteCarMethod()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && (isset($_POST["submitDeleteCar"]) && $_POST["submitDeleteCar"])) {

            // get data from form
            $submittedToken = htmlspecialchars($_POST["token_csrf"]);
            $id             = htmlspecialchars(trim($_POST["idCarDelete"]));

            // Check token CSRF
            $token   = new TokenCsrf();
            $isValid = $token->validateToken($submittedToken);

            if ($isValid) {
                $carRepo = new CarRepository();
                $carRepo->deleteCar($id);
            }

        }
    }

    protected function deleteUserMethod()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && (isset($_POST["deleteProfil"]) && $_POST["deleteProfil"])) {

            // get data from form
            $submittedToken = htmlspecialchars($_POST["tokenProfil"]);
            $id             = $_SESSION["id"];

            // Check token CSRF
            $token   = new TokenCsrf();
            $isValid = $token->validateToken($submittedToken);

            if ($isValid) {
                $profilContr = new ProfilContr();
                $profilContr->deleteUser($id);
            }

        }
    }

}
