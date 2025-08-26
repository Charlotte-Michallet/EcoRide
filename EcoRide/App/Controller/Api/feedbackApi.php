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
        $resulTripStatus      = $result["tripStatus"];
        $resultreservationId  = $result["reservationId"];
        $resultprice          = $result["price"];
        $resultidDriver       = $result["idDriver"];

        $tripStatus          = htmlspecialchars(trim($resulTripStatus));
        $submittedToken      = htmlspecialchars($resultSubmittedToken);
        $reservationIdString = htmlspecialchars(trim($resultreservationId));
        $priceString         = htmlspecialchars(trim($resultprice));
        $driveridString      = htmlspecialchars(trim($resultidDriver));

        $reservationId = (int) $reservationIdString;
        $price         = (int) $priceString;
        $driverid      = (int) $driveridString;
        $rating        = null;
        $feedback      = null;

        if (isset($result["ratting"])) {
            $resultratting = $result["ratting"];
            $rattingString = htmlspecialchars(trim($resultratting));
            $rating        = (int) $rattingString;
        }

        if (isset($result["feedbacktext"])) {
            $resultfeedback = $result["feedbacktext"];
            $feedback       = htmlspecialchars(trim($resultfeedback));
        }

        $token   = new TokenCsrf();
        $isValid = $token->validateToken($submittedToken);

        if ($isValid) {
            $feedbackContr = new FeedbackContr($tripStatus, $rating, $feedback, $reservationId, $driverid, $price);
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
