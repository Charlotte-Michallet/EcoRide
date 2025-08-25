<?php
namespace App\Controller\CarSharing;

use App\Repository\FeedbackRepository;
use App\Repository\ReservationRepository;

class FeedbackContr
{

    protected int $ratting;
    protected string $feedback;
    protected int $reservationId;

    public function __construct(int $ratting, string $feedback, int $reservationId)
    {
        $this->ratting       = $ratting;
        $this->feedback      = $feedback;
        $this->reservationId = $reservationId;
    }

    public function checkData()
    {
        $errors = [];
        $userId = $_SESSION["id"];

        if ($this->InputEmpty() === true) {
            $errors = ["Tous les champs sont obligatoires."];
            return $errors;
        }

        if ($this->numberPlacesInvalid() === true) {
            $errors = ["Le champs nombre de place est incorrect"];
            return $errors;
        }

        if ($this->feedbacktextInvalid() === true) {
            $errors = ["Le champs ne doit pas avoir de caractere speciaux"];
            return $errors;
        }

        if ($this->reservationidInvalid() === true) {
            $errors = ["La reservation id est manquand ou incorrect"];
            return $errors;
        }

        if (! empty($errors)) {
            return $errors;
        } else {
            $status       = "En attente de validation";
            $feedbackRepo = new FeedbackRepository();
            $feedback     = $feedbackRepo->createFeedback($this->ratting, $this->feedback, $userId, $status, $this->reservationId);

            if (empty($feedback)) {
                $errors = ["Il y a eu une erreur"];
                return $errors;
            } else {
                $status   = "Avis en attente de validation";
                $resarepo = new ReservationRepository();
                $resarepo->updateRervationStatus($this->reservationId, $status);
            }
        }
    }

    public function InputEmpty()
    {
        if (empty($this->ratting) || empty($this->feedback) || empty($this->reservationId)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function numberPlacesInvalid()
    {
        if (filter_var($this->ratting, FILTER_VALIDATE_INT) === false || ($this->ratting < 1 || $this->ratting > 5)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function reservationidInvalid()
    {
        if (filter_var($this->reservationId, FILTER_VALIDATE_INT) === false) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function feedbacktextInvalid()
    {
        if (! preg_match("/^[a-zA-Z0-9\s\-.&+\/()[\]!,;:\é\è\à\ç\ù]+$/", $this->feedback)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
