<?php
namespace App\Controller\Car;

use App\Repository\CarRepository;

class CarContr
{
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
                echo "Tous les champs sont obligatoires.";
                return $errors;
            }

            if ($this->inputInvalid() === true) {
                $errors = ["Les champs sont invalid"];
                echo "Les champs sont invalid";
                return $errors;
            }

            if ($this->carTaken() === true) {
                $errors = ["La voiture est déjà enregistrer"];
                echo "La voiture est déjà enregistrer";
                return $errors;
            }

            if (! is_numeric($this->num_seats)) {
                echo "Ce champs doit etre numerique";
                $errors = ["Ce champs doit etre numerique"];
                return $errors;
            }

            if ($errors) {
                $_SESSION["errorRegister"] = $errors;
                exit();

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
        if (empty($this->brand || $this->model || $this->energy_type || $this->num_seats || $this->numplate || $this->first_register_date || $this->color)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function inputInvalid()
    {
        if (! preg_match("/^[a-zA-Z0-9]*$/", $this->brand) || ! preg_match("/^[a-zA-Z0-9_]*$/", $this->model) || ! preg_match("/^[a-zA-Z0-9]*$/", $this->energy_type) || ! preg_match("/^[a-zA-Z0-9]*$/", $this->color) || ! preg_match("/^[0-9]*$/", $this->num_seats) || ! preg_match("/^[a-zA-Z0-9-]*$/", $this->numplate)) {
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
