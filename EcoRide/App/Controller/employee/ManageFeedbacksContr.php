<?php
namespace App\Controller\Employee;

use App\Repository\FeedbackRepository;
use App\Repository\ReservationRepository;

class ManageFeedbacksContr
{
    public function manageFeedback($statusfeedback, $feedbackid, $idreservationid, $statusreservation, $paymentStatus)
    {
        // update feedback

        $feedbackRepo = new FeedbackRepository();
        $feedbackRepo->Upadatefeedback($statusfeedback, $feedbackid);

        // update reservation
        $reservaRepo = new ReservationRepository();
        $reservaRepo->updateRervationStatus($idreservationid, $statusreservation);

        $reservaRepo->updateRervationpayement($idreservationid, $paymentStatus);

        // envoyer mail

    }
}
