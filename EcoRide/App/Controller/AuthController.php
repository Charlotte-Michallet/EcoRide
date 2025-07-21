<?php

namespace App\Controller;

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

                    default:
                        throw new \Exception("Cette action n'existe pas" . $_GET["action"]);
                }
            } else {
                // home page
            }
        } catch (\Exception $e) {
            $this->render('errors/default', ["error" => $e->getMessage()]);
        }
    }

    // Methods for redirecting pages
    protected function login()
    {
        // generate token CSRF
        $tokenObj = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        if (!$currentToken) {
            error_log('Tentative de connexion bloquée : Jeton CSRF invalide. IP: ');
            header("Location: http://localhost:8080/index.php?controller=auth&action=login");
            exit();
        }

        // show page
        $this->render("auth/login", ["token" => $currentToken]);
        $this->loginMethod();
    }

    protected function register()
    {
        // generate token CSRF
        $tokenObj = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        // show page
        $this->render("auth/register", ["token" => $currentToken]);
        $this->registerMethod();
    }
    protected function profil()
    {
        // generate token CSRF
        $tokenObj = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        // show page
        $this->render("auth/profil", ["token" => $currentToken]);
    }

    // Methods for getting data

    protected function loginMethod()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // get data from form
            $email      = htmlspecialchars(trim($_POST["emailLogin"]));
            $password         = htmlspecialchars(trim($_POST["pwdLogin"]));
            $submittedToken = htmlspecialchars($_POST["token_csrf"]);

            // Check token CSRF
            $token = new TokenCsrf();
            $isValid =   $token->validateToken($submittedToken);
            if ($isValid) {
                // check user
                $login = new LogingContr($email, $password);
                $login->checkImputLoginUser();
            }
        }
    }


    protected function registerMethod()
    {
        // if post method
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // get data from form
            $submittedToken = htmlspecialchars($_POST["token_csrf"]);
            $username      = htmlspecialchars(trim($_POST["usernameRegister"]));
            $email         = htmlspecialchars(trim($_POST["emailRegister"]));
            $date_of_birth = htmlspecialchars(trim($_POST["dateBirthRegister"]));
            $password      = htmlspecialchars(trim($_POST["pwdRegister"]));
            $passwordVerif = htmlspecialchars(trim($_POST["ConfPwdRegister"]));
            $role          = htmlspecialchars(trim($_POST["userRolesRegister"]));
            $credits       = 20;
            $id_role       = $this->userRole($role);

            // Check token CSRF
            $token = new TokenCsrf();
            $isValid =   $token->validateToken($submittedToken);
            if ($isValid) {
                // Create user
                $register = new RegisterContr($username, $email, $password, $passwordVerif, $date_of_birth, $credits, $id_role);
                $register->checkImputRegisterUser();
            }
        }
    }

    protected function userRole(string $role)
    {
        // if post method
        switch ($role) {

            case 'admin':
                return 1;

            case 'empl':
                return 2;

            case 'driver':
                return 3;

            case 'passenger':
                return 4;

            case 'driverAndPassenger':
                return 5;

            default:
                return 6;
        }
    }
}
