<?php
namespace App\Controller\CarSharing;

use App\Repository\ReservationRepository;
use App\Repository\TripRepository;
use App\Repository\UserRepository;

class ReservationContr
{
    public function reservation($carSharingId, $userId, $reservationDate, $numSeatsBookes, $paymentStatus, $status, $creditsUsed)
    {
        $error = [];
        // Creation reservation
        $random            = rand(1000, 9999);
        $timestamp         = microtime(true);
        $reservationNumber = str_replace(".", "", $timestamp . $random);

        $reservaRepo = new ReservationRepository();
        $reserva     = $reservaRepo->createReservation($carSharingId, $userId, $reservationDate, $numSeatsBookes, $paymentStatus, $status, $reservationNumber, $creditsUsed);

        // Update credits
        if (! empty($reserva)) {
            $user          = new UserRepository();
            $creditsUser   = $user->usercredits($userId);
            $creditsLafted = $creditsUser - $creditsUsed;

            $creditsUpdated = $user->UpdatecreditsTrip($userId, $creditsLafted);
            if (! empty($creditsUpdated)) {
                // MAJ PLACE
                $tripRepo = new TripRepository();
                $seats    = $tripRepo->seatsTrip($carSharingId);

                $seatsAvailable = $seats - $numSeatsBookes;

                $updateseats = $tripRepo->updatetSeatsTrip($seatsAvailable, $carSharingId);

                if (empty($updateseats)) {
                    $error[] = "la mise a jour du covoiturage n'a pas marche";
                }

            } else {
                $error[] = "la mise a jour du credit na pas marché";
            }
        } else {
            $error[] = "reservation na pas marche";
        }

        return $error;
    }
}
{

}
