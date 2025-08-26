<?php
namespace Admin\App\Controller;

use Admin\App\Repository\CompanyRepository;
use Admin\App\Repository\Mongo\PlateformCreditsRepository;
use Admin\App\Repository\TripRepo;
use DateTime;

class CompanyContr
{
    public function updateCreditsCompany()
    {
        $creditsForCompany = 2;
        $companyRepo       = new CompanyRepository();
        $creditsCompany    = $companyRepo->showcredits();

        $updatedCreditsCompany = $creditsForCompany + $creditsCompany;

        $companyRepo->updateCredits($updatedCreditsCompany);

    }

    public function createJurnalCredits($paymentStatusTrip, $totalPrice, $reservationId, $carSharingId, $reservationDate, $passengerId, $numSeatsBookes)
    {
        $transactionId         = $this->generateTransactionId();
        $paymmentStatusCompany = "validé";
        $priceCompany          = 2;

        $tripRepo = new TripRepo();
        $tripInfo = $tripRepo->getInfoJurnal($carSharingId);

        $driverId      = $tripInfo["driverId"];
        $citydeparture = $tripInfo["departureCity"];
        $cityarrival   = $tripInfo["arrivalCity"];
        $hourTrip      = $tripInfo["departureHour"];

        $today           = new DateTime();
        $dateTransaction = $today->format("Y-m-d");

        $mongoRepo     = new PlateformCreditsRepository();
        $idTransaction = $mongoRepo->transactionReceipt($transactionId, $paymmentStatusCompany, $dateTransaction, $priceCompany, $reservationId, $paymentStatusTrip, $totalPrice, $passengerId, $reservationDate, $hourTrip, $numSeatsBookes, $carSharingId, $driverId, $citydeparture, $cityarrival);

        if ($idTransaction) {
            header("Location: /index.php?controller=trips&action=manageTrip");
            exit();
        } else {
            header("Location: /index.php?controller=car-sharing&action=show");
            exit();
        }
    }

    private function generateTransactionId()
    {
        $pref       = "TRANS-" . date("dmY-His");
        $randomPart = bin2hex((random_bytes(4)));
        return $pref . "-" . $randomPart;
    }
}
