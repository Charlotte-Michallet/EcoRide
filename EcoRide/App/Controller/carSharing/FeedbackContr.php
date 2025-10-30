<?php
namespace App\Controller\CarSharing;

use App\Controller\Admin\CompanyContr;
use App\Repository\FeedbackRepository;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;

class FeedbackContr
{
    protected ?int $rating;
    protected ?string $feedback;
    protected int $reservationId;
    protected string $tripStatus;
    protected int $driverId;
    protected int $price;

    public function __construct(string $tripStatus, ?int $rating, ?string $feedback, int $reservationId, int $driverId, int $price)
    {
        $this->tripStatus    = $tripStatus;
        $this->rating        = $rating;
        $this->feedback      = $feedback;
        $this->reservationId = $reservationId;
        $this->driverId      = $driverId;
        $this->price         = $price;
    }

    public function checkData()
    {
        $errors = [];
        $userId = $_SESSION["id"];

        if ($this->TripInputsEmpty() === true) {
            $errors = ["Le champ doit être rempli."];
            return $errors;
        }

        if (! filter_var($this->price, FILTER_VALIDATE_INT) || ! filter_var($this->driverId, FILTER_VALIDATE_INT)) {
            $errors = ["Ces champs doivent être des nombres"];
            return $errors;
        }

        if ($this->reservationidInvalid() === true) {
            $errors = ["L'ID de réservation est manquant ou incorrect."];
            return $errors;
        }

        if ($this->tripStatusInvalid() === true) {
            $errors = ["Vous n'avez pas renseigné si le trajet s'est bien passé"];
            return $errors;
        }

        if ($this->feedback !== null && $this->feedbacktextInvalid()) {
            $errors = ["Le champ ne doit pas contenir de caractères spéciaux"];
            return $errors;
        }

        if ($this->rating !== null && $this->numberPlacesInvalid()) {
            $errors = ["Le champ nombre de places est incorrect."];
            return $errors;
        }

        if (! empty($errors)) {
            return $errors;

        } else {

            if ($this->tripStatus === "Non" && $this->rating === null && $this->feedback === null) {
                $feedbackStatus    = "En attente de contact";
                $statusReservation = "En attente de contact";

            } elseif ($this->tripStatus === "Oui" && $this->rating === null && $this->feedback === null) {
                $feedbackStatus    = "Enregistré";
                $statusReservation = "Note enregistré";
            } else {
                $feedbackStatus    = "En attente de validation";
                $statusReservation = "Avis en attente de validation";
            }

            if ($this->tripStatus === "Oui") {
                $statusPayment = "Validé";
                $priceDriver   = $this->price - 2;

                $driverRepo         = new UserRepository();
                $creditsuser        = $driverRepo->usercredits($this->driverId);
                $updatedcreditsUser = $creditsuser + $priceDriver;

                $driverRepo->UpdatecreditsTrip($this->driverId, $updatedcreditsUser);
            } else {
                $statusPayment = "En attente de contact";
            }

            $feedbackRepo = new FeedbackRepository();
            $feedbackRepo->createFeedback($this->tripStatus, $this->rating, $this->feedback, $userId, $feedbackStatus, $this->reservationId);

            $resarepo = new ReservationRepository();
            $resarepo->updateRervationStatus($this->reservationId, $statusReservation);

            $resarepo->updateRervationpayement($this->reservationId, $statusPayment);
            $companyContr = new CompanyContr();
            $update       = $companyContr->updateStatusPayment($this->reservationId, $statusPayment);

            if ($update) {
                $errors = ["La mise à jour du reçu n'a pas marché"];
                return $errors;
            }
        }
    }

    public function TripInputsEmpty()
    {
        if (empty($this->tripStatus) || empty($this->driverId) || empty($this->reservationId) || empty($this->price)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function numberPlacesInvalid()
    {
        if (filter_var($this->rating, FILTER_VALIDATE_INT) === false || ($this->rating < 1 || $this->rating > 5)) {
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

    protected function tripStatusInvalid()
    {
        if ($this->tripStatus !== "Oui" && $this->tripStatus !== "Non") {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
