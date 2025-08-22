<?php
namespace Admin\App\Controller\Api;

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
        $credits   = ["labels" => [1, 2, 3, 4, 5, 6, 7, 8, 9], "data" => [5, 2, 7, 8, 10, 9, 1, 12, 14]];

        $dataSend = ["tripsInfo" => $tripsInfo, "credits" => $credits];

        echo json_encode($dataSend);

    }
}
