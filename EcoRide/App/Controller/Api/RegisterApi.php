<?php
namespace App\Controller\Api;

use App\Controller\Auth\RegisterContr;
use App\Controller\Router;
use App\Controller\TokenCsrf;

class RegisterApi
{
    public function registerData()
    {
        $data   = file_get_contents("php://input");
        $result = json_decode($data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Router::jsonResponse(["status" => "error", "message" => "Format des données JSON invalide."], 400);
            return;
        };

        // get data from form
        $resultSubmittedToken = $result["token"];
        $resultRole           = $result["role"];
        $resultUsername       = $result["username"];
        $resultEmail          = $result["email"];
        $resultDob            = $result["dob"];
        $resultPassword       = $result["password"];
        $resultPwdVerify      = $result["pwdVerify"];

        // escape special caractares
        $submittedToken = htmlspecialchars($resultSubmittedToken);
        $role           = htmlspecialchars(trim($resultRole));
        $username       = htmlspecialchars(trim($resultUsername));
        $email          = htmlspecialchars(trim($resultEmail));
        $date_of_birth  = htmlspecialchars(trim($resultDob));
        $password       = htmlspecialchars(trim($resultPassword));
        $passwordVerif  = htmlspecialchars(trim($resultPwdVerify));
        $credits        = 20;
        $id_role        = $this->userRole($role);

        // Check token CSRF
        $token   = new TokenCsrf();
        $isValid = $token->validateToken($submittedToken);

        if ($isValid) {
            // Create user
            $register      = new RegisterContr($username, $email, $password, $passwordVerif, $date_of_birth, $credits, $id_role);
            $registererror = $register->checkImputRegisterUser();

            if (! empty($registererror)) {
                Router::jsonResponse(["status" => "error", "message" => "Le pseudo ou l'adresse mail exist déjà."], 401);
            } else {
                Router::jsonResponse(["status" => "success", "message" => "Login success"], 200);
            }
        } else {
            Router::jsonResponse(["status" => "error", "message" => "Token CSRF invalide."], 403);
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

            case 'driverAndPassengerR':
                return 5;

            default:
                return 6;
        }
    }
}
