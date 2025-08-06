<?php
namespace App\Controller\Api;

use App\Controller\Car\CreateTripContr;
use App\Controller\Router;
use App\Controller\TokenCsrf;

class CreateTripApi
{
    public function tripData()
    {
        $data   = file_get_contents("php://input");
        $result = json_decode($data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Router::jsonResponse(["status" => "error", "message" => "Format des données JSON invalide."], 400);
            return;
        };

        // get data from form
        $resultSubmittedToken = $result["token"];
        $resultdepartCity     = $result["departCity"];
        $resultarrivalCity    = $result["arrivalCity"];
        $resultcarId          = $result["carId"];
        $resultdateDeparture  = $result["dateDeparture"];
        $resulthourDeparture  = $result["hourDeparture"];
        $resultnumPlaces      = $result["numPlaces"];
        $resultpricePlaces    = $result["pricePlaces"];

        // escape special caractares
        $submittedToken = htmlspecialchars($resultSubmittedToken);
        $departCity     = htmlspecialchars(trim($resultdepartCity));
        $arrivalCity    = htmlspecialchars(trim($resultarrivalCity));
        $carId          = htmlspecialchars(trim($resultcarId));
        $dateDeparture  = htmlspecialchars(trim($resultdateDeparture));
        $hourDeparture  = htmlspecialchars(trim($resulthourDeparture));
        $numPlaces      = htmlspecialchars(trim($resultnumPlaces));
        $pricePlaces    = htmlspecialchars(trim($resultpricePlaces));

        // Check token CSRF
        $token   = new TokenCsrf();
        $isValid = $token->validateToken($submittedToken);

        $user_id = $_SESSION["id"];

        if ($isValid) {

            $tripContr = new CreateTripContr($departCity, $arrivalCity, $numPlaces, $dateDeparture, $hourDeparture, $pricePlaces, $carId, $user_id);

            $tripError = $tripContr->checkImputs();

            if (! empty($tripError)) {
                Router::jsonResponse(["status" => "error", "message" => $tripError], 401);
            } else {
                Router::jsonResponse(["status" => "success", "message" => "L'inscription réussi."], 200);
            }
        } else {
            Router::jsonResponse(["status" => "error", "message" => "Token CSRF invalide."], 403);
        }

    }
}
