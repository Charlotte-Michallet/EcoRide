<?php
namespace App\Controller;

use DateTime;

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
        $this->render("auth/login");
    }
    protected function register()
    {
        $this->render("auth/register");
        $this->registermethod();
    }
    protected function profil()
    {
        $this->render("auth/profil");
    }

    // Methods for getting data

    protected function registermethod()
    {
        // if post method
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $username      = htmlspecialchars(trim($_POST["usernameRegister"]));
            $email         = htmlspecialchars(trim($_POST["emailRegister"]));
            $date_of_birth = htmlspecialchars(trim($_POST["dateBirthRegister"]));
            $password      = htmlspecialchars(trim($_POST["pwdRegister"]));
            $passwordVerif = htmlspecialchars(trim($_POST["ConfPwdRegister"]));
            $role          = htmlspecialchars(trim($_POST["userRolesRegister"]));
            $credits       = 20;
            $id_role       = $this->userRole($role);

            $register = new RegisterContr($username, $email, $password, $passwordVerif, $date_of_birth, $credits, $id_role);
            $register->checkImputRegisterUser();

            // show legal page
            $this->render("auth/register");
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
