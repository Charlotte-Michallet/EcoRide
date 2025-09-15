<?php
namespace App\Controller;

use App\Controller\Auth\ProfilContr;
use App\Repository\CarRepository;
use App\Repository\FeedbackRepository;
use App\Repository\UserRepository;

class AuthController extends Router
{

    public function route($meta)
    {
        try {
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case 'login':
                        $this->login($meta);
                        break;

                    case 'register':
                        $this->register($meta);
                        break;

                    case 'profil':
                        $this->profil($meta);
                        break;

                    case 'profilModify':
                        $this->profilModify($meta);
                        break;

                    case 'cars':
                        $this->cars($meta);
                        break;

                    case 'credits':
                        $this->credits($meta);
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

    // Methods for redirecting pages
    protected function login($meta)
    {
        // generate token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        // show page
        $this->render("auth/login", ["token" => $currentToken, "meta" => $meta["login"]]);
    }

    protected function register($meta)
    {
        // generate token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        // show page
        $this->render("auth/register", ["token" => $currentToken, "meta" => $meta["register"]]);
    }

    protected function profil($meta)
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

            $this->render("auth/profil", ["token" => $currentToken, "user" => $user, "preferences" => $preferences, "feedbacks" => $feedbacks, "meta" => $meta["profil"]]);

            $this->deleteUserMethod();
        } else {
            header("Location: /index.php");
            exit();
        }
    }

    protected function profilModify($meta)
    {
        $userId       = $_SESSION["id"];
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        if ($userId) {

            $userRepo = new UserRepository();
            $user     = $userRepo->userInfo($userId);

            // show page
            $this->render("auth/modifyProfil", ["user" => $user, "token" => $currentToken, "meta" => $meta["profilModify"]]);
        } else {
            header("Location: /index.php");
            exit();
        }
    }

    protected function cars($meta)
    {
        $user_id = $_SESSION["id"];

        if ($user_id) {
            // generate token CSRF
            $tokenObj     = new TokenCsrf();
            $currentToken = $tokenObj->getGenerateToken();

            $carRepo  = new CarRepository();
            $carsInfo = $carRepo->showUserCars($user_id);

            $this->deleteCarMethod();

            // show page
            $this->render("userTrips/userCars", ["token" => $currentToken, "cars" => $carsInfo, "meta" => $meta["cars"]]);
        } else {
            header("Location: index.php");
            exit();
        }
    }

    protected function credits($meta)
    {
        $user_id = $_SESSION["id"];

        if ($user_id) {
            // generate token CSRF
            $tokenObj     = new TokenCsrf();
            $currentToken = $tokenObj->getGenerateToken();

            $userRepo = new UserRepository();
            $credits  = $userRepo->usercredits($user_id);

            // show page
            $this->render("auth/credit", ["token" => $currentToken, "credits" => $credits, "meta" => $meta["credits"]]);
        } else {
            header("Location: /index.php");
            exit();
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
