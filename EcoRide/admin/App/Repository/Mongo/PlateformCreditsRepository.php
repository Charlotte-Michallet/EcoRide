<?php
namespace Admin\App\Repository\Mongo;

use DateTime;
use MongoDB\BSON\UTCDateTime;
use MongoDB\Exception\Exception;

class PlateformCreditsRepository extends MongoRepository
{
    public function transactionReceipt($transactionId, $paymmentStatusCompany, $dateTransaction, $priceCompany, $reservationId, $paymentStatusTrip, $totalPrice, $passengerId, $reservationDate, $hourTrip, $numSeatsBookes, $carSharingId, $driverId, $citydeparture, $cityarrival)
    {
        try {
            $collection = $this->getCollection('Transactions');

            $mongoDateTransaction = new UTCDateTime((new DateTime($dateTransaction))->getTimestamp() * 1000);
            $reservationfulldate  = $reservationDate . " " . $hourTrip;
            $mongoReservationDate = new UTCDateTime((new DateTime($reservationfulldate))->getTimestamp() * 1000);

            $receiptTransaction = [
                "transactionID"  => $transactionId,
                "companyPayment" => [
                    "status"          => $paymmentStatusCompany,
                    "price"           => $priceCompany,
                    "dateTransaction" => $mongoDateTransaction,
                ],
                "tripDetails"    => [
                    "reservationID"     => $reservationId,
                    "paymentTripStatus" => $paymentStatusTrip,
                    "totalprice"        => $totalPrice,
                    "dateTrip"          => $mongoReservationDate,
                    "passengerID"       => $passengerId,
                    "seatsBooked"       => $numSeatsBookes,
                    "carSharingID"      => $carSharingId,
                    "driverId"          => $driverId,
                    "departureCity"     => $citydeparture,
                    "arrivalCity"       => $cityarrival,
                ],
            ];

            $result = $collection->insertOne($receiptTransaction);
            return (string) $result->getInsertedId();

        } catch (Exception $e) {
            error_log("Erreur lors de l'insertion du document MongoDB: " . $e->getMessage());
            return null;
        }
    }
    public function updateCreditsPlatform()
    {}
}
