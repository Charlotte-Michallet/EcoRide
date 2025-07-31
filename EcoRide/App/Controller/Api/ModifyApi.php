<?php
namespace App\Controller\Api;

use App\Controller\Auth\ModifyProContr;
use App\Controller\Router;
use App\Controller\TokenCsrf;

class ModifyApi
{
    public function modifyData()
    {
        $data   = file_get_contents("php://input");
        $result = json_decode($data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Router::jsonResponse(["status" => "error", "message" => "Format des données JSON invalide."], 400);
            return;
        }

        $user_id = $_SESSION["id"];

        // get data from form
        $resultSubmittedToken = $result["token"];
        $submittedToken       = htmlspecialchars($resultSubmittedToken);

        // Check token CSRF
        $token   = new TokenCsrf();
        $isValid = $token->validateToken($submittedToken);

        if ($isValid) {

            $userModify = new ModifyProContr();

            if (isset($result["role"])) {
                //     $resultRole = $result["role"];
                //     $role       = htmlspecialchars(trim($resultRole));
                //     $id_role    = $this->userRole($role);
                Router::jsonResponse(["status" => "success", "message" => "La modification a été prise en compte."], 200);
                return;

            } elseif (isset($result["username"])) {

                $resultUsername = $result["username"];
                $username       = htmlspecialchars(trim($resultUsername));

                $userError = $userModify->checkUsername($username, $user_id);
                if (! empty($userError)) {
                    Router::jsonResponse(["status" => "error", "message" => $userError], 422);
                    return;
                } else {
                    Router::jsonResponse(["status" => "success", "message" => "La modification a été prise en compte."], 200);
                    return;
                }

            } elseif (isset($result["email"])) {
                $resultEmail = $result["email"];
                $email       = htmlspecialchars(trim($resultEmail));

                $userError = $userModify->checkEmail($email, $user_id);
                if (! empty($userError)) {
                    Router::jsonResponse(["status" => "error", "message" => $userError], 422);
                    return;
                }
                Router::jsonResponse(["status" => "success", "message" => "La modification a été prise en compte."], 200);
                return;

            } elseif (isset($result["photo"])) {
                //     $resultPhoto = $result["photo"];
                //     $photo       = htmlspecialchars(trim($resultPhoto));
                //     break;
                Router::jsonResponse(["status" => "success", "message" => "La modification a été prise en compte."], 200);
                return;
            } elseif (isset($result["license"])) {
                //     $resultLicense = $result["license"];
                //     $license       = htmlspecialchars(trim($resultLicense));
                //     break;
                Router::jsonResponse(["status" => "success", "message" => "La modification a été prise en compte."], 200);
                return;
            } elseif (isset($result["password"])) {
                //     $resultPassword  = $result["password"];
                //     $resultPwdVerify = $result["pwdVerify"];
                //     $password        = htmlspecialchars(trim($resultPassword));
                //     $passwordVerif   = htmlspecialchars(trim($resultPwdVerify));
                //     break;
                Router::jsonResponse(["status" => "success", "message" => "La modification a été prise en compte."], 200);
                return;
            } elseif (isset($result["animal"])) {
                //     $resultAnimal = $result["animal"];
                //     $animal       = htmlspecialchars(trim($resultAnimal));
                //     break;
                Router::jsonResponse(["status" => "success", "message" => "La modification a été prise en compte."], 200);
                return;
            } elseif (isset($result["smoking"])) {
                //     $resultSmoking = $result["smoking"];
                //     $smoking       = htmlspecialchars(trim($resultSmoking));
                //     break;
                Router::jsonResponse(["status" => "success", "message" => "La modification a été prise en compte."], 200);
                return;
            } elseif (isset($result["preferences"])) {
                //     $resultPreferences = $result["preferences"];
                //     $preferences       = htmlspecialchars(trim($resultPreferences));
                //     break;
                Router::jsonResponse(["status" => "success", "message" => "La modification a été prise en compte."], 200);
                return;
            } else {
                Router::jsonResponse(["status" => "error", "message" => "aucune donnée ne correspond"], 401);
                return;
            }

        } else {
            Router::jsonResponse(["status" => "error", "message" => "Token CSRF invalide."], 403);
            return;
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
