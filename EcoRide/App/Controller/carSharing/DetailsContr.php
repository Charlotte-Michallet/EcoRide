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
        $notes           = $detailsBool->getNotes();
        $notepassenger   = $detailsBool->getNote();
        $feedback        = $detailsBool->getFeedback();

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

        if ($notes === null) {
            $details["notes"] = "Aucune notes";
        } else {
            $details["notes"] = $notes;
        }

        if ($notepassenger === null) {
            $details["notepassenger"] = "";
        } else {
            $details["notepassenger"] = $notepassenger;
        }

        if ($feedback === null) {
            $details["feedback"] = "";
        } else {
            $details["feedback"] = $feedback;
        }

        return $details;
    }

}
