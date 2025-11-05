<?php
namespace App\Controller\Api;

use App\Controller\CarSharing\ShowTripContr;
use App\Controller\Router;

class FilterApi
{
    public function filterData()
    {
        $data   = file_get_contents("php://input");
        $result = json_decode($data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Router::jsonResponse(["status" => "error", "message" => "Format des données JSON invalide."], 400);
            return;
        }

        // get data from form
        $filter = [
            "ecoTrip"     => htmlspecialchars(trim($result["btnEco"] ?? '')),
            "starsNumber" => isset($result["starsNumber"]) ? (int) $result["starsNumber"] : null,
            "priceMax"    => isset($result["priceMax"]) ? (int) $result["priceMax"] : null,
            "timeMax"     => htmlspecialchars(trim($result["timeMax"] ?? '')),
        ];

        $departureCity = $result["departure"];
        $arrivalCity   = $result["arrival"];
        $dateTrip      = $result["date"];
        $seatsString   = $result["seats"];
        $seats         = (int) $seatsString;

        $showTripContr = new ShowTripContr($departureCity, $arrivalCity, $dateTrip, $seats, $filter);
        $checkInputs   = $showTripContr->checkFilterInputs();

        if (! empty($checkInputs)) {
            Router::jsonResponse(["status" => "error", "message" => $checkInputs], 402);
        } else {
            $trips = $showTripContr->getTripsFilter();

            if (empty($trips)) {
                Router::jsonResponse(["status" => "error", "message" => "Aucun trajet trouvé avec ces paramètres."]);
            } else {
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
                        "notes"      => $trip->getNotes(),
                    ];
                }
                Router::jsonResponse(["status" => "success", "message" => "La création de trajer réussi", "trips" => $tripsArray], 200);
            }
        }
    }
}
