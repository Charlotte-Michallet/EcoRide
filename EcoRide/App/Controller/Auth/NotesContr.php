<?php
namespace App\Controller\Auth;

use App\Repository\FeedbackRepository;
use App\Repository\TripRepository;
use App\Repository\UserRepository;

class NotesContr
{
    public function notesAverageDriver($idFeedback, $idreservation)
    {
        $tripRepo   = new TripRepository();
        $driverInfo = $tripRepo->driverIdPriceTrip($idreservation);
        $driverId   = $driverInfo["user_id"];

        $feedbackRepo = new FeedbackRepository();
        $countNotes   = $feedbackRepo->countNotesDriver($driverId);

        $notes = $feedbackRepo->sumNotesDriver($driverId);

        $averageNoteDriver = $notes / $countNotes;

        $userRepo = new UserRepository();
        $userRepo->driverNotes($averageNoteDriver, $driverId);
    }
}
