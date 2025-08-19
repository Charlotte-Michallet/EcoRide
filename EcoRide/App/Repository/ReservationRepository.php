<?php
namespace App\Repository;

use App\Entity\Reservation;

class ReservationRepository extends Repository
{
    public function createReservation(int $carSharingId, int $userId, string $reservationDate, int $numSeatsBookes, string $paymentStatus, string $status, string $num_reser, int $creditTotal)
    {
        $query = $this->pdo->prepare("INSERT INTO reservations (number_reser, car_sharing_id, user_id, reservation_date, num_seats_bookes, payment_status, status, totalPrice) VALUES(:number_reser, :car_sharing_id, :user_id, :reservation_date, :numSeatsBookes, :payment_status, :status, :totalPrice);");

        // bind value from form to query
        $query->bindValue(":car_sharing_id", $carSharingId, $this->pdo::PARAM_INT);
        $query->bindValue(":user_id", $userId, $this->pdo::PARAM_INT);
        $query->bindValue(":reservation_date", $reservationDate, $this->pdo::PARAM_STR);
        $query->bindValue(":numSeatsBookes", $numSeatsBookes, $this->pdo::PARAM_INT);
        $query->bindValue(":payment_status", $paymentStatus, $this->pdo::PARAM_STR);
        $query->bindValue(":status", $status, $this->pdo::PARAM_STR);
        $query->bindValue(":number_reser", $num_reser, $this->pdo::PARAM_STR);
        $query->bindValue(":totalPrice", $creditTotal, $this->pdo::PARAM_INT);

        $query->execute();
        $query->fetch(\PDO::FETCH_ASSOC);

        $lastInsertedId = $this->pdo->lastInsertId();

        // Hydration
        $reservationInfo = new Reservation();
        $reservationInfo->setId($lastInsertedId);
        $reservationInfo->setCarSharingId($carSharingId);
        $reservationInfo->setUserId($userId);
        $reservationInfo->setNumSeatsBookes($numSeatsBookes);
        $reservationInfo->setPaymentStatus($paymentStatus);
        $reservationInfo->setStatus($status);
        $reservationInfo->setNumReser($num_reser);
        $reservationInfo->setTotalprice($creditTotal);

        return $reservationInfo;
    }

    public function showReservationHistory($user_id)
    {
        try {
            $todayTime = new \DateTime();
            $today     = $todayTime->format("Y-m-d");

            $query = $this->pdo->prepare("SELECT r.id, r.number_reser, r.car_sharing_id, r.num_seats_bookes, r.payment_status, r.status AS resaStatus, r.totalPrice, s.departure_city, s.arrival_city, s.departure_date, s.departure_hour, s.arrival_time, s.car_id, s.status, s.kilometers, s.travel_time, c.brand, c.model, c.color, u.username FROM reservations r INNER JOIN car_sharing s on r.car_sharing_id = s.id INNER JOIN cars c on s.car_id = c.id INNER JOIN users u on c.user_id = u.id WHERE r.user_id = :user_id AND s.departure_date < :today ORDER BY departure_date ASC, departure_hour ASC;");

            // bind value from form to query
            $query->bindValue(":user_id", $user_id, $this->pdo::PARAM_INT);
            $query->bindValue(":today", $today);
            $query->execute();

            $reservationsData = $query->fetchAll(\PDO::FETCH_ASSOC);
            $reservations     = [];

            // Hydration
            foreach ($reservationsData as $reservationData) {
                $dateObject = new \DateTime($reservationData["departure_date"]);
                $dateTrip   = $dateObject->format("d/m/Y");

                $reservationInfo = new Reservation();
                $reservationInfo->setId($reservationData["id"]);
                $reservationInfo->setNumReser($reservationData["number_reser"]);
                $reservationInfo->setCarSharingId($reservationData["car_sharing_id"]);
                $reservationInfo->setNumSeatsBookes($reservationData["num_seats_bookes"]);
                $reservationInfo->setPaymentStatus($reservationData["payment_status"]);
                $reservationInfo->setStatus($reservationData["resaStatus"]);
                $reservationInfo->setDepartureCity($reservationData["departure_city"]);
                $reservationInfo->setArrivalCity($reservationData["arrival_city"]);
                $reservationInfo->setDepartureDate($dateTrip);
                $reservationInfo->setDepartureHour($reservationData["departure_hour"]);
                $reservationInfo->setArrivalTime($reservationData["arrival_time"]);
                $reservationInfo->setPrice($reservationData["totalPrice"]);
                $reservationInfo->setCarId($reservationData["car_id"]);
                $reservationInfo->setStatusCarSharing($reservationData["status"]);
                $reservationInfo->setKilometers($reservationData["kilometers"]);
                $reservationInfo->setTravelTime($reservationData["travel_time"]);
                $reservationInfo->setBrand($reservationData["brand"]);
                $reservationInfo->setModel($reservationData["model"]);
                $reservationInfo->setColor($reservationData["color"]);
                $reservationInfo->setUsername($reservationData["username"]);
                $reservationInfo->setTotalprice($reservationData["totalPrice"]);

                $reservations[] = $reservationInfo;
            }

            return $reservations;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function ReservaManage($user_id)
    {
        try {

            $todayTime = new \DateTime();
            $today     = $todayTime->format("Y-m-d");

            $query = $this->pdo->prepare(" SELECT r.id, r.number_reser, r.car_sharing_id, r.num_seats_bookes, r.payment_status, r.status AS resaStatus, r.totalPrice, s.departure_city, s.arrival_city, s.departure_date, s.departure_hour, s.arrival_time, s.car_id, s.status, s.kilometers, s.travel_time, c.brand, c.model, c.color, u.username FROM reservations r INNER JOIN car_sharing s on r.car_sharing_id = s.id INNER JOIN cars c on s.car_id = c.id INNER JOIN users u on c.user_id = u.id WHERE r.user_id = :user_id AND s.departure_date >= :today ORDER BY departure_date ASC, departure_hour ASC;");

            // bind value from form to query
            $query->bindValue(":user_id", $user_id, $this->pdo::PARAM_INT);
            $query->bindValue(":today", $today);
            $query->execute();

            // Hydration
            $reservationsData = $query->fetchAll(\PDO::FETCH_ASSOC);
            $reservations     = [];

            // Hydration
            foreach ($reservationsData as $reservationData) {

                $dateObject = new \DateTime($reservationData["departure_date"]);
                $dateTrip   = $dateObject->format("d/m/Y");

                $reservationInfo = new Reservation();
                $reservationInfo->setId($reservationData["id"]);
                $reservationInfo->setNumReser($reservationData["number_reser"]);
                $reservationInfo->setCarSharingId($reservationData["car_sharing_id"]);
                $reservationInfo->setNumSeatsBookes($reservationData["num_seats_bookes"]);
                $reservationInfo->setPaymentStatus($reservationData["payment_status"]);
                $reservationInfo->setStatus($reservationData["resaStatus"]);
                $reservationInfo->setDepartureCity($reservationData["departure_city"]);
                $reservationInfo->setArrivalCity($reservationData["arrival_city"]);
                $reservationInfo->setDepartureDate($dateTrip);
                $reservationInfo->setDepartureDateFormat($reservationData["departure_date"]);
                $reservationInfo->setDepartureHour($reservationData["departure_hour"]);
                $reservationInfo->setArrivalTime($reservationData["arrival_time"]);
                $reservationInfo->setPrice($reservationData["totalPrice"]);
                $reservationInfo->setCarId($reservationData["car_id"]);
                $reservationInfo->setStatusCarSharing($reservationData["status"]);
                $reservationInfo->setKilometers($reservationData["kilometers"]);
                $reservationInfo->setTravelTime($reservationData["travel_time"]);
                $reservationInfo->setBrand($reservationData["brand"]);
                $reservationInfo->setModel($reservationData["model"]);
                $reservationInfo->setColor($reservationData["color"]);
                $reservationInfo->setUsername($reservationData["username"]);
                $reservationInfo->setTotalprice($reservationData["totalPrice"]);

                $reservations[] = $reservationInfo;
            }

            return $reservations;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteTrip($id)
    {
        try {
            $query = $this->pdo->prepare("DELETE FROM reservations WHERE id = :id;");
            $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
            $query->execute();

            $rowCount = $query->rowCount();

            if ($rowCount > 0) {
                return true;
            } else {
                return false;
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
