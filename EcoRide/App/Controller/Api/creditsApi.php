<?php
namespace App\Controller\Api;

use App\Controller\Auth\CreditsCrontr;
use App\Controller\Router;
use App\Controller\TokenCsrf;

class CreditsApi
{
    public function creditsData()
    {
        $data   = file_get_contents("php://input");
        $result = json_decode($data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Router::jsonResponse(["status" => "error", "message" => "Format des données JSON invalide."], 400);
            return;
        }

        $resultSubmittedToken = $result["token"];
        $resultcredits        = $result["credits"];

        $submittedToken = htmlspecialchars($resultSubmittedToken);
        $creditsString  = htmlspecialchars(trim($resultcredits));
        $credits        = (int) $creditsString;
        $token          = new TokenCsrf();
        $isValid        = $token->validateToken($submittedToken);

        if ($isValid) {

            $creditsContr  = new CreditsCrontr($credits);
            $creditsUpdate = $creditsContr->checkCredits();

            if (! empty($creditsUpdate)) {
                Router::jsonResponse(["status" => "error", "message" => $creditsUpdate], 401);
            } else {
                Router::jsonResponse(["status" => "success", "message" => "Les credits sont mise a jours"], 200);
            }
        } else {
            Router::jsonResponse(["status" => "error", "message" => "Token CSRF invalide."], 403);
        }
    }
}
