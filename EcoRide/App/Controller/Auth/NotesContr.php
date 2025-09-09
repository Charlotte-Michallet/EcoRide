<?php
namespace App\Controller\Auth;

use App\Repository\FeedbackRepository;
use App\Repository\TripRepository;
use App\Repository\UserRepository;

class NotesContr
{
    public function notesAverageDriver($idreservation, $noteFeedback)
    {
        $tripRepo   = new TripRepository();
        $driverInfo = $tripRepo->driverIdPriceTrip($idreservation);
        $driverId   = $driverInfo["user_id"];

        $feedbackRepo = new FeedbackRepository();
        $countNotes   = $feedbackRepo->countNotesDriver($driverId);

        $notes = $feedbackRepo->sumNotesDriver($driverId);

        if (is_null($notes)) {
            $averageNoteDriver = $noteFeedback;
        } else {
            $totalnotes        = $notes + $noteFeedback;
            $totalFeedbacks    = $countNotes + 1;
            $averageNoteDriver = $totalnotes / $totalFeedbacks;
        }

        $userRepo = new UserRepository();
        $userRepo->driverNotes($averageNoteDriver, $driverId);
    }
}
