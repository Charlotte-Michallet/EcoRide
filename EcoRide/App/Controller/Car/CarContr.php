<?php
namespace App\Controller\Car;

use App\Repository\CarRepository;

class CarContr
{
    private int $id;
    private string $brand;
    private string $model;
    private string $energy_type;
    private int $num_seats;
    private string $numplate;
    private string $first_register_date;
    private string $color;
    private int $user_id;

    public function __construct(string $brand, string $model, string $energy_type, int $num_seats, string $numplate, string $first_register_date, string $color, int $user_id)
    {
        $this->brand               = $brand;
        $this->model               = $model;
        $this->energy_type         = $energy_type;
        $this->num_seats           = $num_seats;
        $this->numplate            = $numplate;
        $this->first_register_date = $first_register_date;
        $this->color               = $color;
        $this->user_id             = $user_id;
    }

    public function checkImputs()
    {
        $errors = [];
        try {

            if ($this->InputEmpty() === true) {
                $errors = ["Tous les champs sont obligatoires."];
                return $errors;
            }

            if ($this->brandModelInvalid() === true) {
                $errors = ["La marque ou model sont invalid"];
                return $errors;
            }

            if ($this->energyInvalid() === true) {
                $errors = ["L'energie doit etre renseigner"];
                return $errors;
            }

            if (! is_numeric($this->num_seats)) {
                $errors = ["Ce champs doit etre numerique"];
                return $errors;
            }

            if ($this->numPlateInvalid() === true) {
                $errors = ["Les champs sont invalid"];
                return $errors;
            }

            if ($this->dateRegisterInvalid() === true) {
                $errors = ["Les champs sont invalid"];
                return $errors;
            }

            if ($this->colorInvalid() === true) {
                $errors = ["Les champs sont invalid"];
                return $errors;
            }

            if ($this->carTaken() === true) {
                $errors = ["La voiture est déjà enregistrer"];
                return $errors;
            }

            if (! empty($errors)) {
                return $errors;

            } else {

                $repoCar = new CarRepository();
                $repoCar->createCar($this->brand, $this->model, $this->energy_type, $this->num_seats, $this->numplate, $this->first_register_date, $this->color, $this->user_id);

            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    protected function InputEmpty()
    {
        if (empty($this->brand) || empty($this->model) || empty($this->energy_type) || empty($this->num_seats) || empty($this->numplate) || empty($this->first_register_date) || empty($this->color)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function brandModelInvalid()
    {
        if (! preg_match("/^[a-zA-Z0-9\s\-.&+\/()[\]]+$/", $this->brand) || ! preg_match("/^[a-zA-Z0-9\s\-.&+\/()[\]]+$/", $this->model)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function energyInvalid()
    {
        if (! preg_match("/^[a-zA-Z]*$/", $this->energy_type) || $this->energy_type === "Energy") {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function numPlateInvalid()
    {
        if (preg_match("/^[A-HJ-NP-TV-Z]{2}[- ]?\d{3}[- ]?[A-HJ-NP-TV-Z]{2}$/", $this->numplate) || preg_match("/^\d{1,4}[ ]?[A-Z]{1,3}[ ]?\d{2}$/", $this->numplate)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    protected function dateRegisterInvalid()
    {
        $today     = new \DateTimeImmutable();
        $datePlate = \DateTimeImmutable::createFromFormat('Y-m-d', $this->first_register_date);

        if ($datePlate > $today) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function colorInvalid()
    {
        if (! preg_match("/^[a-zA-Z\s]*[a-zA-Z][a-zA-Z\s]*$/", $this->color)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function carTaken()
    {
        $carRepo = new CarRepository();
        if ($carRepo->checkCarInDb($this->numplate)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
