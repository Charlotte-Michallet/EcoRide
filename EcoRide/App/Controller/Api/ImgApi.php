<?php
namespace App\Controller\Api;

use App\Controller\Auth\ModifyProContr;
use App\Controller\Router;
use App\Controller\TokenCsrf;

class ImgApi
{
    public function imgData()
    {
        if (! isset($_FILES['image'])) {
            Router::jsonResponse(["status" => "error", "message" => "Aucun fichier reçu."], 400);
            return;
        }

        $submittedToken = $_POST["token"];
        $token          = new TokenCsrf();
        $isValid        = $token->validateToken($submittedToken);

        if ($isValid) {

            $user_id = $_SESSION['id'];

            $photo = $_FILES['image'];

            $userModify = new ModifyProContr();
            $errors     = $userModify->checkPhoto($photo, $user_id);

            if (! empty($errors)) {
                Router::jsonResponse(["status" => "error", "message" => $errors], 422);
                return;
            } else {
                Router::jsonResponse(["status" => "success", "message" => "La modification a été prise en compte."], 200);
                return;
            }

        } else {
            Router::jsonResponse(["status" => "error", "message" => "Token CSRF invalide."], 403);
            return;
        }
    }
}
