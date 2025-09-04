<?php
namespace App\Controller\Api;

use App\Controller\Auth\LoginContr;
use App\Controller\Router;
use App\Controller\TokenCsrf;

class LoginApi
{
    public function loginData()
    {
        $data   = file_get_contents("php://input");
        $result = json_decode($data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Router::jsonResponse(["status" => "error", "message" => "Format des données JSON invalide."], 400);
            return;
        }

        // get data from form
        $resultSubmittedToken = $result["token"];
        $resultEmail          = $result["email"];
        $resultPassword       = $result["password"];

        // escape special caractares
        $submittedToken = htmlspecialchars($resultSubmittedToken);
        $email          = htmlspecialchars(trim($resultEmail));
        $password       = htmlspecialchars(trim($resultPassword));

        // Check token CSRF
        $token   = new TokenCsrf();
        $isValid = $token->validateToken($submittedToken);

        if ($isValid) {

            // Check user
            $login = new LoginContr($email, $password);
            $user  = $login->checkInputLoginUser();

            if (is_array($user)) {
                Router::jsonResponse(["status" => "error", "message" => $user], 401);
            } else {
                Router::jsonResponse(["status" => "success", "message" => "Connexion réussie."], 200);
            }

        } else {
            Router::jsonResponse(["status" => "error", "message" => "Token CSRF invalide."], 403);
        }
    }
}
