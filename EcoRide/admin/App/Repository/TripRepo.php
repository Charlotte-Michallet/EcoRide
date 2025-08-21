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

}
