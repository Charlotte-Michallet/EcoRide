<?php
namespace App\Controller\Api;

use App\Controller\CarSharing\FeedbackContr;
use App\Controller\Router;
use App\Controller\TokenCsrf;

class FeedbackApi
{
    public function feedbackData()
    {
        $data   = file_get_contents("php://input");
        $result = json_decode($data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Router::jsonResponse(["status" => "error", "message" => "Format des données JSON invalide."], 400);
            return;
        }

        $resultSubmittedToken = $result["token"];
        $resultratting        = $result["ratting"];
        $resultfeedback       = $result["feedbacktext"];
        $resultreservationId  = $result["reservationId"];

        $submittedToken      = htmlspecialchars($resultSubmittedToken);
        $rattingString       = htmlspecialchars(trim($resultratting));
        $feedback            = htmlspecialchars(trim($resultfeedback));
        $reservationIdString = htmlspecialchars(trim($resultreservationId));

        $ratting       = (int) $rattingString;
        $reservationId = (int) $reservationIdString;

        $token   = new TokenCsrf();
        $isValid = $token->validateToken($submittedToken);

        if ($isValid) {
            $feedbackContr = new FeedbackContr($ratting, $feedback, $reservationId);
            $feedback      = $feedbackContr->checkData();

            if (! empty($feedback)) {
                Router::jsonResponse(["status" => "error", "message" => $feedback], 401);
            } else {
                Router::jsonResponse(["status" => "success", "message" => "Les credits sont mise a jours"], 200);
            }
        } else {
            Router::jsonResponse(["status" => "error", "message" => "Token CSRF invalide."], 403);
        }
    }
}
