<?php
namespace App\Repository;

use App\Entity\Trip;

class TripRepository extends Repository
{
    public function CreateTrip($departure_city, $arrival_city, $num_places, $date_trip, $hour_trip, $price, $car_id, $arrival_time)
    {
        try {
            $query = $this->pdo->prepare("INSERT INTO car_sharing (car_id, departure_city, arrival_city, departure_date, departure_hour, arrival_time, price, num_seats) VALUES(:car_id, :departure_city, :arrival_city, :departure_date, :departure_hour, :arrival_time, :price, :num_seats);");

            // bind value from form to query

            $query->bindValue(":car_id", $car_id, $this->pdo::PARAM_INT);
            $query->bindValue(":departure_city", $departure_city, $this->pdo::PARAM_STR);
            $query->bindValue(":arrival_city", $arrival_city, $this->pdo::PARAM_STR);
            $query->bindValue(":departure_date", $date_trip, $this->pdo::PARAM_STR);
            $query->bindValue(":departure_hour", $hour_trip, $this->pdo::PARAM_STR);
            $query->bindValue(":arrival_time", $arrival_time);
            $query->bindValue(":price", $price, $this->pdo::PARAM_INT);
            $query->bindValue(":num_seats", $num_places, $this->pdo::PARAM_INT);

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
            return $tripInfo;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
