<?php
namespace App\Controller\Car;

class CreateTripContr
{
    private int $id;
    private string $departure_city;
    private string $arrival_city;
    private int $num_places;
    private string $date_trip;
    private string $hour_trip;
    private int $price;
    private int $car_id;
    private int $user_id;

    public function __construct(string $departure_city, string $arrival_city, int $num_places, string $date_trip, string $hour_trip, int $price, int $car_id, int $user_id)
    {
        $this->departure_city = $departure_city;
        $this->arrival_city   = $arrival_city;
        $this->num_places     = $num_places;
        $this->date_trip      = $date_trip;
        $this->hour_trip      = $hour_trip;
        $this->price          = $price;
        $this->car_id         = $car_id;
        $this->user_id        = $user_id;
    }

    public function checkImputs()
    {
        $errors = [];
        try {
            if ($this->InputEmpty() === true) {
                $errors = ["Tous les champs sont obligatoires."];
                return $errors;
            }

            if ($this->departureCityInvalid() === true) {
                $errors = ["La marque ou model sont invalid"];
                return $errors;
            }

            if ($this->departureCityInvalid() === true) {
                $errors = ["La marque ou model sont invalid"];
                return $errors;
            }

            if ($this->numberPlacesInvalid() === true) {
                $errors = ["Les champs sont invalid"];
                return $errors;
            }

            if ($this->departuredateInvalid() === true) {
                $errors = ["Les champs sont invalid"];
                return $errors;
            }

            if ($this->departurehourInvalid() === true) {
                $errors = ["Les champs sont invalid"];
                return $errors;
            }

            if ($this->priceInvalid() === true) {
                $errors = ["La voiture est déjà enregistrer"];
                return $errors;
            }

            if ($this->carIdInvalid() === true) {
                $errors = ["La voiture doit etre choisi."];
                return $errors;
            }

            if (! empty($errors)) {
                return $errors;
            } else {

                // $repoCar = new CarRepository();
                // $repoCar->createCar($this->brand, $this->model, $this->energy_type, $this->num_seats, $this->numplate, $this->first_register_date, $this->color, $this->user_id);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    protected function InputEmpty()
    {
        if (empty($this->departure_city) || empty($this->arrival_city) || empty($this->date_trip) || empty($this->hour_trip) || empty($this->price) || empty($this->car_id) || empty($this->num_places)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    protected function departureCityInvalid()
    {}
    protected function arrivalCityInvalid()
    {}
    protected function numberPlacesInvalid()
    {
        if (filter_var($this->num_places, FILTER_VALIDATE_INT) === false || ($this->num_places > 1 && $this->num_places < 9)) {
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

}
