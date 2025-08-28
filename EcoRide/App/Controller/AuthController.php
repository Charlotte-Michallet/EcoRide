<?php
namespace App\Controller;

use App\Controller\Auth\ProfilContr;
use App\Repository\CarRepository;
use App\Repository\FeedbackRepository;
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

                    case 'credits':
                        $this->credits();
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
        $userId       = $_SESSION["id"];
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        if ($userId) {

            $userRepo = new UserRepository();
            $user     = $userRepo->userInfo($userId);

            $profilContr = new ProfilContr();
            $preferences = $profilContr->Preferences($userId);

            $feedbackRepo = new FeedbackRepository();
            $feedbacks    = $feedbackRepo->showFeedback($userId);

            $this->render("auth/profil", ["token" => $currentToken, "user" => $user, "preferences" => $preferences, "feedbacks" => $feedbacks]);

            $this->deleteUserMethod();
        } else {
            header("Location: /index.php");
        }
    }

    protected function profilModify()
    {
        $userId       = $_SESSION["id"];
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        if ($userId) {

            $userRepo = new UserRepository();
            $user     = $userRepo->userInfo($userId);

            // show page
            $this->render("auth/modifyProfil", ["user" => $user, "token" => $currentToken]);
        } else {
            header("Location: /index.php");
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
        } else {
            header("Location: index.php");
        }
    }

    protected function credits()
    {
        $user_id = $_SESSION["id"];

        if ($user_id) {
            // generate token CSRF
            $tokenObj     = new TokenCsrf();
            $currentToken = $tokenObj->getGenerateToken();

            $userRepo = new UserRepository();
            $credits  = $userRepo->usercredits($user_id);

            // show page
            $this->render("auth/credit", ["token" => $currentToken, "credits" => $credits]);
        } else {
            header("Location: /index.php");
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
