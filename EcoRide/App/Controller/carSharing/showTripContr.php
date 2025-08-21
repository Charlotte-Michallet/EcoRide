<?php
namespace App\Controller\CarSharing;

use App\Repository\TripRepository;

class ShowTripContr extends TripContr
{
    public function __construct($departure_city, $arrival_city, $date_trip, int $numPlaces)
    {
        $this->departure_city = $departure_city;
        $this->arrival_city   = $arrival_city;
        $this->num_places     = $numPlaces;
        $this->date_trip      = $date_trip;

    }

    public function checkInputs()
    {
        $errors = [];

        if ($this->InputEmpty() === true) {
            $errors = ["Tous les champs sont obligatoires."];
            return $errors;
        }

        $departureValidation = $this->departureCityInvalid();
        if ($departureValidation === true || isset($departureValidation["valide"]) && $departureValidation["valide"] === false) {
            $errors = ["Les informations de la ville de depart sont incorrect"];
            return $errors;
        }

        $arrivalalidation = $this->arrivalCityInvalid();
        if ($arrivalalidation === true || isset($arrivalalidation["valide"]) && $arrivalalidation["valide"] === false) {
            $errors = ["Les informations de la ville de depart sont incorrect"];
            return $errors;
        }

        if ($this->departuredateInvalid() === true) {
            $errors = ["Le champs date de dapart est incorrect"];
            return $errors;
        }

        if ($this->numberPlacesInvalid() === true) {
            $errors = ["Le champs nombre de place est incorrect"];
            return $errors;
        }
        return $errors;
    }

    public function getTrips()
    {
        $user_id = null;

        if (isset($_SESSION["id"]) && ! empty($_SESSION["id"])) {
            $user_id = $_SESSION["id"];
        }
        $tripRepo = new TripRepository();

        $checkTrip = $tripRepo->findTrip($this->departure_city, $this->arrival_city, $this->date_trip, $this->num_places, $user_id);

        if ($checkTrip === "trajet trouvés") {
            $trips = $tripRepo->showAllTrips($this->departure_city, $this->arrival_city, $this->date_trip, $this->num_places, $user_id);
            return $trips;
        } elseif ($checkTrip === true) {

            $newDateTrip      = $tripRepo->findotherTrip($this->departure_city, $this->arrival_city, $this->date_trip, $this->num_places, $user_id);
            $errors["errors"] = ["Des covoiturage sont dispobles au " . $newDateTrip];
            return $errors;
        } else {
            $errors["errors"] = ["Aucun trajet trouver a cette date et ces villes"];
            return $errors;
        }
    }

    public function InputEmpty()
    {
        if (empty($this->departure_city) || empty($this->arrival_city) || empty($this->date_trip) || empty($this->num_places)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function departureCityInvalid()
    {
        if (! isset($this->departure_city["display_name"]) && ! isset($this->departure_city["lat"]) && ! isset($this->departure_city["lon"])) {
            $result = true;

        } else {
            $city = $this->departure_city["display_name"];

            $cityEncode = urlencode($city);

            $url = "https://nominatim.openstreetmap.org/search?q=$cityEncode&countrycodes=fr&format=json";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, "tonNomOutSiteWeb/1.0");

            $response = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($response, true);

            if (! empty($data)) {
                $this->departure_city = $data[0]["name"];
                return $this->departure_city;

            } else {
                return [
                    "valide"  => false,
                    "message" => "ville non trouvée",
                ];
            }
        }
        return $result;
    }

    protected function arrivalCityInvalid()
    {
        if (! isset($this->arrival_city["display_name"]) && ! isset($this->arrival_city["lat"]) && ! isset($this->arrival_city["lon"])) {
            $result = true;

        } else {
            $city = $this->arrival_city["display_name"];

            $cityEncode = urlencode($city);

            $url = "https://nominatim.openstreetmap.org/search?q=$cityEncode&countrycodes=fr&format=json";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, "tonNomOuSiteWeb/1.0");

            $response = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($response, true);

            if (! empty($data)) {
                $this->arrival_city = $data[0]["name"];
                return $this->arrival_city;

            } else {
                return [
                    "valide"  => false,
                    "message" => "ville non trouvée",
                ];
            }
        }
        return $result;
    }

    protected function numberPlacesInvalid()
    {
        if (filter_var($this->num_places, FILTER_VALIDATE_INT) === false || ($this->num_places < 1 || $this->num_places > 8)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function departuredateInvalid()
    {
        $today    = new \DateTimeImmutable();
        $dateTrip = \DateTimeImmutable::createFromFormat('Y-m-d', $this->date_trip);

        if ($dateTrip <= $today) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;

    }
}
