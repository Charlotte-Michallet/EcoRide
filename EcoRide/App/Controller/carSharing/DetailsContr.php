<?php
namespace App\Controller\CarSharing;

use App\Repository\TripRepository;

class DetailsContr
{
    public function details($id)
    {
        $detailsRepo = new TripRepository();
        $detailsBool = $detailsRepo->otherDetails($id);

        $details = [];

        $animal_allowed  = $detailsBool->isAnimalAllowed();
        $smoking_allowed = $detailsBool->isSmokingAllowed();
        $descriptif      = $detailsBool->getDescription();

        if ($animal_allowed === true) {
            $details["animal"] = "Oui";
        } else {
            $details["animal"] = "Non";
        }

        if ($smoking_allowed === true) {
            $details["smoking"] = "Oui";
        } else {
            $details["smoking"] = "Non";
        }

        if ($descriptif === null) {
            $details["descriptif"] = "";
        } else {
            $details["descriptif"] = $descriptif;
        }
        return $details;
    }
}
