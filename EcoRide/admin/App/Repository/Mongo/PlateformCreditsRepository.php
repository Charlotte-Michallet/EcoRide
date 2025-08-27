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
    public function updatetransactionReceipt($reservationId, $statusPayment)
    {
        try {
            $collection = $this->getCollection('Transactions');

            $filter = [
                "tripDetails.reservationID" => $reservationId,
            ];

            $update = [
                '$set' => [
                    "tripDetails.paymentTripStatus" => $statusPayment,
                ],
            ];

            $result = $collection->updateOne($filter, $update);
            return $result->getModifiedCount() > 0;

        } catch (Exception $e) {
            error_log("Erreur lors de l'insertion du document MongoDB: " . $e->getMessage());
            return null;
        }
    }

    public function deletetransactionReceipt($transactionId)
    {
        try {
            $collection = $this->getCollection('Transactions');

            $filter = [
                "transactionID" => $transactionId,
            ];

            $result = $collection->deleteOne($filter);

            return $result->getDeletedCount() > 0;

        } catch (Exception $e) {
            error_log("Erreur lors de l'insertion du document MongoDB: " . $e->getMessage());
            return null;
        }
    }

    public function showTransation()
    {
        try {
            $collection = $this->getCollection('Transactions');

            $option = [
                "sort" => ["companyPayment.dateTransaction" => -1],
            ];

            $cusrsor = $collection->find([], $option);

            $transactions = $cusrsor->toArray();

            return $transactions;

        } catch (Exception $e) {
            error_log("Erreur lors de l'insertion du document MongoDB: " . $e->getMessage());
            return null;
        }
    }

    public function calcTransation()
    {
        try {
            $collection = $this->getCollection('Transactions');

            $count = $collection->countDocuments();

            return $count;

        } catch (Exception $e) {
            error_log("Erreur lors de l'insertion du document MongoDB: " . $e->getMessage());
            return null;
        }
    }

    public function CreditsToday($todayObjet)
    {
        try {
            $collection = $this->getCollection('Transactions');

            $startOfDay = clone $todayObjet;
            $startOfDay->setTime(0, 0, 0);

            $endOfDay = clone $todayObjet;
            $endOfDay->setTime(23, 59, 59);

            $pipeline = [
                [
                    '$match' => [
                        "companyPayment.dateTransaction" => [
                            '$gte' => new UTCDateTime($startOfDay->getTimestamp() * 1000),
                            '$lte' => new UTCDateTime($endOfDay->getTimestamp() * 1000),
                        ],
                    ],
                ],
                [
                    '$group' => [
                        "_id"          => null,
                        "totalCredits" => ['$sum' => '$companyPayment.price'],
                    ],
                ],
            ];

            $cursor = $collection->aggregate($pipeline);
            $result = $cursor->toArray();

            if (! empty($result)) {
                return $result[0]['totalCredits'];
            }

            return 0;

        } catch (Exception $e) {
            error_log("Erreur lors de l'insertion du document MongoDB: " . $e->getMessage());
            return null;
        }
    }

    public function CreditsPerDay()
    {
        try {
            $collection = $this->getCollection('Transactions');

            $pipeline = [
                [
                    '$group' => [
                        "_id"     => [
                            "day"   => ['$dayOfMonth' => '$companyPayment.dateTransaction'],
                            "month" => ['$month' => '$companyPayment.dateTransaction'],
                            "year"  => ['$year' => '$companyPayment.dateTransaction'],
                        ],
                        "credits" => ['$sum' => '$companyPayment.price'],
                    ],
                ],
                [
                    '$sort' => [
                        "_id.year"  => 1,
                        "_id.month" => 1,
                        "_id.day"   => 1,
                    ],
                ],
                [
                    '$project' => [
                        "_id"   => 0,
                        'label' => [
                            '$concat' => [
                                ['$toString' => '$_id.day'],
                                "/",
                                ['$toString' => '$_id.month'],
                                "/",
                                ['$toString' => '$_id.year'],
                            ],
                        ],
                        'data'  => '$credits',
                    ],
                ],
            ];

            $cursor = $collection->aggregate($pipeline);

            $labels = [];
            $data   = [];

            foreach ($cursor as $document) {
                $labels[] = $document['label'];
                $data[]   = $document['data'];
            }

            return ["labels" => $labels,
                "data"           => $data,
            ];

        } catch (Exception $e) {
            error_log("Erreur lors de l'insertion du document MongoDB: " . $e->getMessage());
            return ["labels" => [], "data" => []];
        }
    }
}
