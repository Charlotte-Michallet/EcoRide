<?php
namespace App\Controller\Api;

use App\Controller\CarSharing\ShowTripContr;
use App\Controller\Router;
use App\Controller\TokenCsrf;

class FindItinaryApi
{
    public function findItinary()
    {

        $data   = file_get_contents("php://input");
        $result = json_decode($data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Router::jsonResponse(["status" => "error", "message" => "Format des données JSON invalide."], 400);
            return;
        }

        // get data from form
        $resultSubmittedToken = $result["token"];
        $resultnumPlaces      = $result["numPlaces"];
        $arrivalCity          = $result["arrivalCity"];
        $resultdateDeparture  = $result["dateDeparture"];
        $departCity           = $result["departCity"];

        // escape special caractares
        $submittedToken  = htmlspecialchars($resultSubmittedToken);
        $dateDeparture   = htmlspecialchars(trim($resultdateDeparture));
        $numPlacesString = htmlspecialchars(trim($resultnumPlaces));

        $numPlaces = (int) $numPlacesString;

        // Check token CSRF
        $token   = new TokenCsrf();
        $isValid = $token->validateToken($submittedToken);

        if ($isValid) {
            $showTripContr = new ShowTripContr($departCity, $arrivalCity, $dateDeparture, $numPlaces);
            $checkInputs   = $showTripContr->checkInputs();
            if (! empty($checkInputs)) {
                Router::jsonResponse(["status" => "error", "message" => $checkInputs], 402);
                return;
            } else {
                $trips      = $showTripContr->getTrips();
                $tripsArray = [];

                foreach ($trips as $trip) {
                    $tripsArray[] = [
                        "id"         => $trip->getId(),
                        "departure"  => $trip->getDepartureCity(),
                        "arrival"    => $trip->getArrivalCity(),
                        "date"       => $trip->getDepartureDate(),
                        "hour"       => $trip->getDepartureHour(),
                        "time"       => $trip->getArrivalTime(),
                        "price"      => $trip->getPrice(),
                        "places"     => $trip->getNumSeats(),
                        "status"     => $trip->getStatus(),
                        "energy"     => $trip->getEnergyTy(),
                        "username"   => $trip->getUsername(),
                        "photo"      => $trip->getPhoto(),
                        "kilometers" => $trip->getKilometers(),
                        "travelTime" => $trip->getTravel_time(),
                    ];
                }
                Router::jsonResponse(["status" => "success", "message" => "La création de trajer réussi", "trips" => $tripsArray], 200);
            }
        } else {
            Router::jsonResponse(["status" => "error", "message" => "Token CSRF invalide."], 403);
        }

    }
}
