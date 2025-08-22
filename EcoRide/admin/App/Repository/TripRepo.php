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

}
