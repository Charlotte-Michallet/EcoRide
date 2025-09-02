<?php
namespace App\Controller\CarSharing;

use App\Repository\TripRepository;

class ShowTripContr
{
    protected int $id;
    protected string|array $departure_city;
    protected string|array $arrival_city;
    protected int $num_places;
    protected string $date_trip;
    protected array $filter = [];

    public function __construct($departure_city, $arrival_city, $date_trip, int $numPlaces, $filter)
    {
        $this->departure_city = $departure_city;
        $this->arrival_city   = $arrival_city;
        $this->num_places     = $numPlaces;
        $this->date_trip      = $date_trip;
        $this->filter         = $filter;
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
            $errors[] = ["Le champs date de dapart est incorrect"];
            return $errors;
        }

        if ($this->numberPlacesInvalid() === true) {
            $errors[] = ["Le champs nombre de place est incorrect"];
            return $errors;
        }
    }

    public function checkFilterInputs()
    {

        $errors = [];

        if ($this->InputfilterEmpty() === true) {
            $errors = ["Au moins un champs doit etre rempli."];
            return $errors;
        }

        if (! empty($this->filter["ecoTrip"]) && $this->filter["ecoTrip"] !== "Electrique") {
            $errors[] = ["La valeur du boutton est incorrect"];
        }

        if (! empty($this->filter["numberStars"]) && $this->numberInvalid() === true) {
            $errors[] = ["Les étoiles doit etre compris entre 1 et 5"];
        }

        if (! empty($this->filter["priceMax"]) && $this->priceInvalid() === true) {
            $errors[] = ["La valeur du prix est incorrect"];
        }

        if (! empty($this->filter["timeMax"]) && $this->timeInvalid() === true) {
            $errors[] = ["La valeur du temps max est incorrect"];
        }
        return $errors;
    }

    public function getTrips()
    {
        $user_id = null;

        if (isset($_SESSION["id"]) && ! empty($_SESSION["id"])) {
            $user_id = $_SESSION["id"];
        }

        $tripRepo  = new TripRepository();
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

    public function getTripsFilter()
    {

        $user_id = null;

        if (isset($_SESSION["id"]) && ! empty($_SESSION["id"])) {
            $user_id = $_SESSION["id"];
        }

        $tripRepo = new TripRepository();
        $trips    = $tripRepo->showAllTripsFilter($this->departure_city, $this->arrival_city, $this->date_trip, $this->num_places, $user_id, $this->filter);

        if (! empty($trips)) {
            return $trips;
        } else {
            $errors["errors"] = ["Aucun trajet trouver avec c'est parametres"];
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

    public function InputfilterEmpty()
    {
        if ((isset($this->filter["ecoTrip"]) && $this->filter["ecoTrip"] !== null) ||
            (isset($this->filter["numberStars"]) && $this->filter["numberStars"] !== null) ||
            (isset($this->filter["priceMax"]) && $this->filter["priceMax"] !== null) ||
            (isset($this->filter["timeMax"]) && $this->filter["timeMax"] !== null)
        ) {
            $result = false;
        } else {
            $result = true;
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

    private function numberInvalid()
    {
        if (filter_var($this->filter["numberStars"], FILTER_VALIDATE_INT) === false || ($this->filter["numberStars"] < 1 || $this->filter["numberStars"] > 5)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    private function timeInvalid()
    {
        if (! preg_match("/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/", $this->filter["timeMax"])) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    private function priceInvalid()
    {
        if (filter_var($this->filter["priceMax"], FILTER_VALIDATE_INT) === false || ($this->filter["priceMax"] < 0)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

}
