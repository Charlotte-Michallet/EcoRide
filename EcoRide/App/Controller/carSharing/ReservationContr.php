<?php
namespace App\Controller\CarSharing;

use App\Controller\Admin\CompanyContr;
use App\Repository\ReservationRepository;
use App\Repository\TripRepository;
use App\Repository\UserRepository;

class ReservationContr
{
    public function reservation($carSharingId, $passengerId, $reservationDate, $numSeatsBookes, $paymentStatus, $status, $creditsUsed)
    {
        $error = [];
        // Creation reservation
        $random            = rand(1000, 9999);
        $timestamp         = microtime(true);
        $reservationNumber = str_replace(".", "", $timestamp . $random);

        $reservaRepo = new ReservationRepository();
        $reserva     = $reservaRepo->createReservation($carSharingId, $passengerId, $reservationDate, $numSeatsBookes, $paymentStatus, $status, $reservationNumber, $creditsUsed);

        // Update credits
        if (! empty($reserva)) {
            $user          = new UserRepository();
            $creditsUser   = $user->usercredits($passengerId);
            $creditsLafted = $creditsUser - $creditsUsed;

            $creditsUpdated = $user->UpdatecreditsTrip($passengerId, $creditsLafted);

            if (! empty($creditsUpdated)) {
                //Update seats
                $tripRepo = new TripRepository();
                $seats    = $tripRepo->seatsTrip($carSharingId);

                $seatsAvailable = $seats - $numSeatsBookes;

                $updateseats = $tripRepo->updatetSeatsTrip($seatsAvailable, $carSharingId);

                if (empty($updateseats)) {
                    $error[] = "La mise à jour du covoiturage n'a pas fonctionné";
                } else {
                    // commision for the plateform
                    $companyContr = new CompanyContr();
                    $companyContr->updateCreditsCompany();

                    // Create a transaction Recipecete
                    $reservationId = $reserva->getId();
                    $totalPrice    = $reserva->getTotalprice();

                    $companyContr->createJurnalCredits($paymentStatus, $totalPrice, $reservationId, $carSharingId, $reservationDate, $passengerId, $numSeatsBookes);
                }

            } else {
                $error[] = "La mise à jour du credit n'a pas fonctionné";
            }
        } else {
            $error[] = "Reservation n'a pas fonctionné";
        }
        return $error;
    }
}
