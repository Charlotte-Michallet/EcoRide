<?php
namespace App\Controller\CarSharing;

class FilterContr
{
    protected ?string $ecoTrip;
    protected ?int $numberStars;
    protected ?int $priceMax;
    protected ?string $timeMax;
    // protected ?string $ecoTrip;

    public function __construct($ecoTrip, $numberStars, $priceMax, $timeMax)
    {
        $this->ecoTrip     = $ecoTrip;
        $this->numberStars = $numberStars;
        $this->priceMax    = $priceMax;
        $this->timeMax     = $timeMax;
    }

    public function checkInputs()
    {
        $errors = [];

        if ($this->InputEmpty() === true) {
            $errors = ["Au moins un champs doit etre rempli."];
            return $errors;
        }

        if (! empty($this->ecoTrip) && $this->ecoTrip !== "eco") {
            $errors = ["La valeur du boutton est incorrect"];
        }

        if (! empty($this->numberStars) && $this->numberInvalid() === true) {
            $errors = ["Les étoiles doit etre compris entre 1 et 5"];
        }

        if (! empty($this->priceMax) && $this->priceInvalid() === true) {
            $errors = ["La valeur du prix est incorrect"];
        }

        if (! empty($this->timeMax) && $this->timeInvalid() === true) {
            $errors = ["La valeur du temps max est incorrect"];
        }

        return $errors;

    }
    private function InputEmpty()
    {
        if (empty($this->ecoTrip) && empty($this->numberStars) && empty($this->priceMax) && empty($this->timeMax)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    private function numberInvalid()
    {
        if (filter_var($this->numberStars, FILTER_VALIDATE_INT) === false || ($this->numberStars < 1 || $this->numberStars > 5)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    private function priceInvalid()
    {
        if (filter_var($this->priceMax, FILTER_VALIDATE_INT) === false || ($this->priceMax < 0)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    private function timeInvalid()
    {

        if (! preg_match("/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/", $this->timeMax)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

}
