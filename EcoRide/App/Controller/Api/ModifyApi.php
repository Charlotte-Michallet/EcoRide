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

                $resultRole = $result["role"];
                $role       = htmlspecialchars(trim($resultRole));
                $id_role    = $this->userRole($role);

                $userError = $userModify->checkRole($id_role, $user_id);
                if (! empty($userError)) {
                    Router::jsonResponse(["status" => "error", "message" => "Le champ doit être rempli."], 422);
                    return;
                } else {
                    Router::jsonResponse(["status" => "success", "message" => "La modification a été prise en compte."], 200);
                    return;
                }

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
                } else {
                    Router::jsonResponse(["status" => "success", "message" => "La modification a été prise en compte."], 200);
                    return;
                }

            } elseif (isset($result["password"])) {
                $resultPassword  = $result["password"];
                $resultPwdVerify = $result["pwdVerify"];

                $password      = htmlspecialchars(trim($resultPassword));
                $passwordVerif = htmlspecialchars(trim($resultPwdVerify));

                $userError = $userModify->checkPassword($password, $passwordVerif, $user_id);
                if (! empty($userError)) {

                    Router::jsonResponse(["status" => "error", "message" => ""], 422);
                    return;
                } else {
                    Router::jsonResponse(["status" => "success", "message" => "La modification a été prise en compte."], 200);
                    return;
                }

            } elseif (isset($result["animal"]) && isset($result["smoking"])) {
                $resultAnimal  = $result["animal"];
                $resultSmoking = $result["smoking"];

                $animal  = htmlspecialchars(trim($resultAnimal));
                $smoking = htmlspecialchars(trim($resultSmoking));

                $userError = $userModify->checkAccept($animal, $smoking, $user_id);

                if (! empty($userError)) {
                    Router::jsonResponse(["status" => "error", "message" => $userError], 422);
                    return;
                } else {
                    Router::jsonResponse(["status" => "success", "message" => "La modification a été prise en compte."], 200);
                    return;
                }
            } elseif (isset($result["preferences"])) {

                $resultPreferences = $result["preferences"];
                $preferences       = htmlspecialchars(trim($resultPreferences));

                $userError = $userModify->checkPreferences($preferences, $user_id);

                if (! empty($userError)) {
                    Router::jsonResponse(["status" => "error", "message" => $userError], 422);
                    return;
                } else {
                    Router::jsonResponse(["status" => "success", "message" => "La modification a été prise en compte."], 200);
                    return;
                }
            } else {
                Router::jsonResponse(["status" => "error", "message" => "Aucune donnée ne correspond."], 401);
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

            case 'emplee':
                return 2;

            case 'driver':
                return 3;

            case 'passenger':
                return 4;

            case 'driverAndPassenger':
                return 5;

            default:
                return null;
        }
    }

}
