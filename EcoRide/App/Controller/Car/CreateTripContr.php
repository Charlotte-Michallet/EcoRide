<?php
namespace App\Controller\Car;

use App\Repository\TripRepository;

class CreateTripContr
{
    private string|array $departure_city;
    private string|array $arrival_city;
    private int $num_places;
    private string $date_trip;
    private string $hour_trip;
    private string $arrival_time;
    private int $kilometers;
    private int $hourtrip;
    private int $minutestrip;
    private string $travel_time;
    private int $price;
    private int $car_id;

    public function __construct(string | array $departure_city, string | array $arrival_city, int $num_places, string $date_trip, string $hour_trip, int $price, int $car_id, int $kilometers, int $hourtrip, int $minutestrip, string $travel_time)
    {

        $this->departure_city = $departure_city;
        $this->arrival_city   = $arrival_city;
        $this->num_places     = $num_places;
        $this->date_trip      = $date_trip;
        $this->hour_trip      = $hour_trip;
        $this->price          = $price;
        $this->car_id         = $car_id;
        $this->kilometers     = $kilometers;
        $this->hourtrip       = $hourtrip;
        $this->minutestrip    = $minutestrip;
        $this->travel_time    = $travel_time;
    }

    public function checkImputs()
    {
        $errors = [];
        try {
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

            if ($this->numberPlacesInvalid() === true) {
                $errors = ["Le champs numero place est incorrect"];
                return $errors;
            }

            if ($this->departurehourInvalid() === true) {
                $errors = ["Le champs heure de depart est incorrect"];
                return $errors;
            }

            if ($this->departuredateInvalid() === true) {
                $errors = ["Le champs date de dapart est incorrect"];
                return $errors;
            }

            if ($this->priceInvalid() === true) {
                $errors = ["Le prix est incorrect"];
                return $errors;
            }

            if ($this->carIdInvalid() === true) {
                $errors = ["La voiture doit etre choisi."];
                return $errors;
            }

            if (is_int($this->kilometers) === false) {
                $errors = ["Les kilometres sont incorrect"];
                return $errors;
            }
            if ($this->travelTileInvalid() === true) {
                $errors = ["Le temps de trajet est incorrect."];
                return $errors;
            }

            if (is_int($this->hourtrip) === false && is_int($this->minutestrip)) {
                $errors = ["Les heures et minutes sont incorrect"];
                return $errors;
            }

            if (! empty($errors)) {
                return $errors;
            } else {

                $this->arrival_time = $this->calcArrivalTime();
                $this->travel_time  = $this->timeformat();

                $tripRepo  = new TripRepository();
                $tripError = $tripRepo->CreateTrip($this->departure_city, $this->arrival_city, $this->num_places, $this->date_trip, $this->hour_trip, $this->price, $this->car_id, $this->arrival_time, $this->kilometers, $this->travel_time);

                if (empty($tripError)) {
                    $errors = ["Il faut remplir les champs avant."];
                    return $errors;
                }
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    protected function InputEmpty()
    {
        if (empty($this->departure_city) || empty($this->arrival_city) || empty($this->date_trip) || empty($this->hour_trip) || empty($this->price) || empty($this->car_id) || empty($this->num_places) || empty($this->kilometers) || empty($this->hourtrip) || empty($this->minutestrip) || empty($this->travel_time)) {

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
        $dateTrip = \DateTimeImmutable::createFromFormat('Y-m-d H:i', $this->date_trip . " " . $this->hour_trip);

        if ($dateTrip < $today) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function departurehourInvalid()
    {
        if (! preg_match("/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/", $this->hour_trip)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function priceInvalid()
    {
        if (filter_var($this->price, FILTER_VALIDATE_INT) === false || $this->price < 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function carIdInvalid()
    {
        if (! preg_match("/^[0-9]+$/", $this->car_id) || $this->car_id === "choose") {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function travelTileInvalid()
    {
        if (! preg_match("/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/", $this->travel_time)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    protected function calcArrivalTime()
    {
        $hours   = $this->hourtrip;
        $minutes = $this->minutestrip;

        $hourTrip = new \DateTime($this->hour_trip);
        $interval = new \DateInterval("PT{$hours}H{$minutes}M");

        $tripTime       = $hourTrip->add($interval);
        $tripTimestring = $tripTime->format("H:i");

        return $tripTimestring;
    }

    protected function timeformat()
    {
        $timeDate     = new \DateTime($this->travel_time);
        $formatedTime = $timeDate->format("H:i");
        return $formatedTime;
    }

}
