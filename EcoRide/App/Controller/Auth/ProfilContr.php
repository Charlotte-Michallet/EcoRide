<?php
namespace App\Controller\Auth;

use App\Repository\UserRepository;

class ProfilContr
{
    public function deleteUser($id)
    {
        try {
            $id = $_SESSION["id"];

            $profilRegister = new UserRepository();
            $profilRegister->deleteUser($id);

            session_unset();
            session_destroy();
            header("Location: /index.php");

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function Preferences($id)
    {
        try {
            $preferences     = [];
            $profilRegister  = new UserRepository();
            $pref            = $profilRegister->userpref($id);
            $animal_allowed  = $pref->isAnimalAllowed();
            $smoking_allowed = $pref->isSmokingAllowed();
            $descriptif      = $pref->getDescription();

            if ($animal_allowed === false) {
                $preferences["animal"]    = "Non";
                $_SESSION["preferencesA"] = "Non";
            } elseif ($animal_allowed === true) {
                $preferences["animal"]    = "Oui";
                $_SESSION["preferencesA"] = "Oui";
            } else {
                $preferences["animal"]    = "Non renseigné";
                $_SESSION["preferencesA"] = "Non renseigné";
            }

            if ($smoking_allowed === false) {
                $preferences["smoking"]   = "Non";
                $_SESSION["preferencesS"] = "Non";
            } elseif ($smoking_allowed === true) {
                $preferences["smoking"]   = "Oui";
                $_SESSION["preferencesS"] = "Oui";
            } else {
                $preferences["smoking"]   = "Non renseigné";
                $_SESSION["preferencesS"] = "Non renseigné";
            }

            if ($descriptif === null) {
                $preferences["descriptif"] = "Non renseigné";
            } else {
                $preferences["descriptif"] = $descriptif;
            }

            return $preferences;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
