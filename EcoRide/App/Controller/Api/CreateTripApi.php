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
        }

        // get data from form
        $resultSubmittedToken = $result["token"];
        $resultpricePlaces    = $result["pricePlaces"];
        $resultnumPlaces      = $result["numPlaces"];
        $resultkilometers     = $result["kilometers"];
        $resulthour           = $result["hour"];
        $resultminites        = $result["minites"];
        $resulttravelTime     = $result["travelTime"];
        $resulthourDeparture  = $result["hourDeparture"];
        $resultcarId          = $result["carId"];
        $arrivalCity          = $result["arrivalCity"];
        $resultdateDeparture  = $result["dateDeparture"];
        $departCity           = $result["departCity"];

        // escape special caractares
        $submittedToken    = htmlspecialchars($resultSubmittedToken);
        $carIdString       = htmlspecialchars(trim($resultcarId));
        $dateDeparture     = htmlspecialchars(trim($resultdateDeparture));
        $hourDeparture     = htmlspecialchars(trim($resulthourDeparture));
        $numPlacesString   = htmlspecialchars(trim($resultnumPlaces));
        $pricePlacesString = htmlspecialchars(trim($resultpricePlaces));
        $kilometersString  = htmlspecialchars(trim($resultkilometers));
        $hourtripString    = htmlspecialchars(trim($resulthour));
        $minutesTripString = htmlspecialchars(trim($resultminites));
        $travelTime        = htmlspecialchars(trim($resulttravelTime));

        $numPlaces   = (int) $numPlacesString;
        $pricePlaces = (int) $pricePlacesString;
        $carId       = (int) $carIdString;
        $kilometers  = (int) $kilometersString;
        $hourtrip    = (int) $hourtripString;
        $minutesTrip = (int) $minutesTripString;

        // Check token CSRF
        $token   = new TokenCsrf();
        $isValid = $token->validateToken($submittedToken);

        if ($isValid) {

            $tripContr = new CreateTripContr($departCity, $arrivalCity, $numPlaces, $dateDeparture, $hourDeparture, $pricePlaces, $carId, $kilometers, $hourtrip, $minutesTrip, $travelTime);

            $tripError = $tripContr->checkImputs();

            if (! empty($tripError)) {
                Router::jsonResponse(["status" => "error", "message" => $tripError], 401);
            } else {
                Router::jsonResponse(["status" => "success", "message" => "La création de trajet réussi"], 200);
            }
        } else {
            Router::jsonResponse(["status" => "error", "message" => "Token CSRF invalide."], 403);
        }
    }
}
