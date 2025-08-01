<?php
namespace App\Controller\Auth;

use App\Entity\Preferences;
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
            header("Location: http://localhost:8080/index.php");

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }

    public function Preferences($id)
    {
        try {
            $profilRegister = new UserRepository();
            $pref           = $profilRegister->userpref($id);

            if ($pref) {
                var_dump($pref);

            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
