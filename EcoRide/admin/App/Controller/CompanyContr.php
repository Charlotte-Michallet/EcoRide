<?php
namespace Admin\App\Controller;

use Admin\App\Repository\CompanyRepository;
use Admin\App\Repository\Mongo\PlateformCreditsRepository;
use Admin\App\Repository\TripRepo;
use App\Repository\ReservationRepository;
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

        $mongoRepo  = new PlateformCreditsRepository();
        $documentId = $mongoRepo->transactionReceipt($transactionId, $paymmentStatusCompany, $dateTransaction, $priceCompany, $reservationId, $paymentStatusTrip, $totalPrice, $passengerId, $reservationDate, $hourTrip, $numSeatsBookes, $carSharingId, $driverId, $citydeparture, $cityarrival);

        if ($documentId) {
            $reservaRepo = new ReservationRepository();
            $reservaRepo->updateRervationidTransaction($reservationId, $transactionId);
            header("Location: /index.php?controller=trips&action=manageTrip");

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

    public function cancelCreditsCompany()
    {
        $creditsForCompany = 2;
        $companyRepo       = new CompanyRepository();
        $creditsCompany    = $companyRepo->showcredits();

        $updatedCreditsCompany = $creditsCompany - $creditsForCompany;

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
            return "La mise à jour du recu na pas marche";
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
