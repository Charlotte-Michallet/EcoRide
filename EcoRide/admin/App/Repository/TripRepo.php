<?php
namespace Admin\App\Repository;

use App\Repository\Repository;

class TripRepo extends Repository
{
    public function totalTrips()
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM car_sharing;");
        $query->execute();

        $totalTrips = $query->fetchColumn();

        return $totalTrips;
    }

    public function tripsPerDay($today)
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM car_sharing WHERE departure_date = :departure_date;");
        $query->bindValue(":departure_date", $today, $this->pdo::PARAM_STR);

        $query->execute();
        $totalTrips = $query->fetchColumn();

        return $totalTrips;
    }

    public function graphiqueTrips()
    {
        $query = $this->pdo->prepare("SELECT departure_date, COUNT(*) FROM car_sharing GROUP BY departure_date ORDER BY departure_date;");
        $query->execute();

        $TripsPerDay = $query->fetchAll();
        return $TripsPerDay;
    }

    public function getInfoJurnal(int $carSharingId)
    {
        $query = $this->pdo->prepare("SELECT s.departure_city, s.arrival_city, s.departure_hour, c.user_id FROM car_sharing s INNER JOIN cars c ON s.car_id = c.id WHERE s.id = :id;");

        // bind value from form to query
        $query->bindValue(":id", $carSharingId, $this->pdo::PARAM_INT);
        $query->execute();

        $tripInfo = $query->fetch(\PDO::FETCH_ASSOC);

        // Hydration
        $infotrip                  = [];
        $infotrip["driverId"]      = $tripInfo["user_id"];
        $infotrip["departureCity"] = $tripInfo["departure_city"];
        $infotrip["arrivalCity"]   = $tripInfo["arrival_city"];
        $infotrip["departureHour"] = $tripInfo["departure_hour"];

        return $infotrip;
    }

}
