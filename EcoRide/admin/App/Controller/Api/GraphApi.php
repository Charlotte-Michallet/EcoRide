<?php
namespace Admin\App\Controller\Api;

use Admin\App\Repository\Mongo\PlateformCreditsRepository;
use Admin\App\Repository\TripRepo;

class GraphApi
{
    public function GraphData()
    {
        $dataSend = [];

        header("Content-Type:application/json ");

        $tripsRepo   = new TripRepo();
        $tripsPerDay = $tripsRepo->graphiqueTrips();

        if (! is_array($tripsPerDay)) {
            $tripsPerDay = [];
        }
        $dates  = [];
        $counts = [];

        foreach ($tripsPerDay as $tripPerDay) {
            $dateobjet = new \DateTime($tripPerDay["departure_date"]);
            $dates[]   = $dateobjet->format("d-m");
            $counts[]  = $tripPerDay["COUNT(*)"];
        }
        $tripsInfo = ["labels" => $dates, "data" => $counts];

        $compoanyRepo   = new PlateformCreditsRepository();
        $creditsPerDate = $compoanyRepo->CreditsPerDay();

        $dataSend = ["tripsInfo" => $tripsInfo, "credits" => $creditsPerDate];

        echo json_encode($dataSend);
    }
}
