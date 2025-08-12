<?php
namespace App\Repository;

use App\Entity\Trip;

class TripRepository extends Repository
{
    public function CreateTrip($departure_city, $arrival_city, $num_places, $date_trip, $hour_trip, $price, $car_id, $arrival_time)
    {
        try {
            $status = "Programmé";
            $query  = $this->pdo->prepare("INSERT INTO car_sharing (car_id, departure_city, arrival_city, departure_date, departure_hour, arrival_time, price, num_seats, status) VALUES(:car_id, :departure_city, :arrival_city, :departure_date, :departure_hour, :arrival_time, :price, :num_seats, :status);");

            // bind value from form to query
            $query->bindValue(":car_id", $car_id, $this->pdo::PARAM_INT);
            $query->bindValue(":departure_city", $departure_city, $this->pdo::PARAM_STR);
            $query->bindValue(":arrival_city", $arrival_city, $this->pdo::PARAM_STR);
            $query->bindValue(":departure_date", $date_trip, $this->pdo::PARAM_STR);
            $query->bindValue(":departure_hour", $hour_trip, $this->pdo::PARAM_STR);
            $query->bindValue(":arrival_time", $arrival_time);
            $query->bindValue(":price", $price, $this->pdo::PARAM_INT);
            $query->bindValue(":num_seats", $num_places, $this->pdo::PARAM_INT);
            $query->bindValue(":status", $status, $this->pdo::PARAM_STR);

            $query->execute();

            $lastInsertedId = $this->pdo->lastInsertId();

            // Hydration
            $tripInfo = new Trip();
            $tripInfo->setId($lastInsertedId);
            $tripInfo->setDepartureCity($departure_city);
            $tripInfo->setArrivalCity($arrival_city);
            $tripInfo->setNumSeats($num_places);
            $tripInfo->setDepartureDate($date_trip);
            $tripInfo->setDepartureHour($hour_trip);
            $tripInfo->setPrice($price);
            $tripInfo->setCarId($car_id);
            $tripInfo->setArrivalTime($arrival_time);
            $tripInfo->setStatus($status);

            return $tripInfo;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function showTripHistory($user_id)
    {
        try {

            $todayTime = new \DateTime();
            $today     = $todayTime->format("Y-m-d");

            $query = $this->pdo->prepare("SELECT s.id, s.departure_city, s.arrival_city, s.departure_date, s.departure_hour, s.arrival_time, s.price, s.num_seats, s.car_id, s.status FROM car_sharing s INNER JOIN cars c on s.car_id = c.id WHERE c.user_id = :user_id AND s.departure_date < :today ORDER BY departure_date ASC, departure_hour ASC;");

            // bind value from form to query
            $query->bindValue(":user_id", $user_id, $this->pdo::PARAM_INT);
            $query->bindValue(":today", $today);
            $query->execute();

            $tripsData = $query->fetchAll(\PDO::FETCH_ASSOC);
            $trips     = [];

            // Hydration
            foreach ($tripsData as $tripData) {
                $tripInfo = new Trip();
                $tripInfo->setId($tripData["id"]);
                $tripInfo->setDepartureCity($tripData["departure_city"]);
                $tripInfo->setArrivalCity($tripData["arrival_city"]);
                $tripInfo->setNumSeats($tripData["num_seats"]);
                $tripInfo->setDepartureDate($tripData["departure_date"]);
                $tripInfo->setDepartureHour($tripData["departure_hour"]);
                $tripInfo->setPrice($tripData["price"]);
                $tripInfo->setCarId($tripData["car_id"]);
                $tripInfo->setArrivalTime($tripData["arrival_time"]);
                $tripInfo->setStatus($tripData["status"]);
                $trips[] = $tripInfo;
            }

            return $trips;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function showTripManage($user_id)
    {
        try {

            $todayTime = new \DateTime();
            $today     = $todayTime->format("Y-m-d");

            $query = $this->pdo->prepare("SELECT s.id, s.departure_city, s.arrival_city, s.departure_date, s.departure_hour, s.arrival_time, s.price, s.num_seats, s.car_id, s.status FROM car_sharing s INNER JOIN cars c on s.car_id = c.id WHERE c.user_id = :user_id AND s.departure_date >= :today ORDER BY departure_date ASC, departure_hour ASC;");

            // bind value from form to query
            $query->bindValue(":user_id", $user_id, $this->pdo::PARAM_INT);
            $query->bindValue(":today", $today);
            $query->execute();

            $tripsData = $query->fetchAll(\PDO::FETCH_ASSOC);
            $trips     = [];

            // Hydration
            foreach ($tripsData as $tripData) {
                $tripInfo = new Trip();
                $tripInfo->setId($tripData["id"]);
                $tripInfo->setDepartureCity($tripData["departure_city"]);
                $tripInfo->setArrivalCity($tripData["arrival_city"]);
                $tripInfo->setNumSeats($tripData["num_seats"]);
                $tripInfo->setDepartureDate($tripData["departure_date"]);
                $tripInfo->setDepartureHour($tripData["departure_hour"]);
                $tripInfo->setPrice($tripData["price"]);
                $tripInfo->setCarId($tripData["car_id"]);
                $tripInfo->setArrivalTime($tripData["arrival_time"]);
                $tripInfo->setStatus($tripData["status"]);
                $trips[] = $tripInfo;
            }

            return $trips;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updatetTrip($status, $id)
    {
        try {
            $query = $this->pdo->prepare("UPDATE car_sharing SET status = :status WHERE id = :id;");

            $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
            $query->bindValue(":status", $status, $this->pdo::PARAM_STR);
            $query->execute();

            $tripInfo = new Trip();
            $tripInfo->setStatus($status);

            header("Location: http://localhost:8080/index.php?controller=trips&action=manageTrip");
            return $tripInfo;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteTrip($id)
    {
        try {
            $query = $this->pdo->prepare("DELETE FROM car_sharing WHERE id = :id;");
            $query->bindValue(":id", $id, $this->pdo::PARAM_STR);
            $query->execute();

            header("Location: http://localhost:8080/index.php?controller=trips&action=manageTrip");

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }

}
