<?php
namespace App\Controller\Admin;

use Admin\App\Repository\Mongo\PlateformCreditsRepository;
use App\Repository\Admin\CompanyRepository;
use App\Repository\Admin\TripRepo;
use App\Repository\ReservationRepository;
use DateTime;

class CompanyContr
{
    private int $creditsForCompany = 2;
    public function updateCreditsCompany()
    {

        $companyRepo    = new CompanyRepository();
        $creditsCompany = $companyRepo->showcredits();

        $updatedCreditsCompany = $this->creditsForCompany + $creditsCompany;

        $companyRepo->updateCredits($updatedCreditsCompany);
    }

    public function createJurnalCredits($paymentStatusTrip, $totalPrice, $reservationId, $carSharingId, $reservationDate, $passengerId, $numSeatsBookes)
    {
        $transactionId         = $this->generateTransactionId();
        $paymmentStatusCompany = "validé";

        $tripRepo = new TripRepo();
        $tripInfo = $tripRepo->getInfoJurnal($carSharingId);

        $driverId      = $tripInfo["driverId"];
        $citydeparture = $tripInfo["departureCity"];
        $cityarrival   = $tripInfo["arrivalCity"];
        $hourTrip      = $tripInfo["departureHour"];

        $today           = new DateTime();
        $dateTransaction = $today->format("Y-m-d");

        $mongoRepo  = new PlateformCreditsRepository();
        $documentId = $mongoRepo->transactionReceipt($transactionId, $paymmentStatusCompany, $dateTransaction, $this->creditsForCompany, $reservationId, $paymentStatusTrip, $totalPrice, $passengerId, $reservationDate, $hourTrip, $numSeatsBookes, $carSharingId, $driverId, $citydeparture, $cityarrival);

        if ($documentId) {
            $reservaRepo = new ReservationRepository();
            $reservaRepo->updateRervationidTransaction($reservationId, $transactionId);
            header("Location: /index.php?controller=trips&action=manageTrip");
            exit();

        } else {
            return false;
        }
    }

    private function generateTransactionId()
    {
        $pref       = "TRANS-" . date("dmY-His");
        $randomPart = bin2hex((random_bytes(4)));
        return $pref . "-" . $randomPart;
    }

    public function cancelCreditsCompany()
    {
        $companyRepo    = new CompanyRepository();
        $creditsCompany = $companyRepo->showcredits();

        $updatedCreditsCompany = $creditsCompany - $this->creditsForCompany;

        $companyRepo->updateCredits($updatedCreditsCompany);
    }

    public function deleteJurnalCredits($idTransaction)
    {
        $mongoRepo = new PlateformCreditsRepository();
        $delete    = $mongoRepo->deletetransactionReceipt($idTransaction);

        if (empty($delete)) {
            header("Location: /index.php?controller=trips&action=manageTrip");
            exit();
        }
    }

    public function updateStatusPayment($reservationId, $statusPayment)
    {
        $mongoRepo = new PlateformCreditsRepository();
        $update    = $mongoRepo->updatetransactionReceipt($reservationId, $statusPayment);

        if (empty($update)) {
            return "La mise à jour du reçu n'a pas fonctionné";
        }
    }

    public function deleteJurnalTrip($idTransaction)
    {
        $mongoRepo = new PlateformCreditsRepository();
        $delete    = $mongoRepo->deletetransactionReceipt($idTransaction);
        if ($delete) {
            return $delete;
        }
    }
}
