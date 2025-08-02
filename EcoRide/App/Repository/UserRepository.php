<?php
namespace App\Repository;

use App\Entity\Preferences;
use App\Entity\User;

class UserRepository extends Repository
{
    public function userInfo(int $id)
    {

        $query = $this->pdo->prepare("SELECT u.id, u.username, u.email, u.date_of_birth, u.photo, r.role, u.credits, u.drivers_license FROM users u INNER JOIN roles r ON u.id_role = r.id WHERE u.id = :id;");

        // bind value from form to query
        $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
        $query->execute();

        $user = $query->fetch(\PDO::FETCH_ASSOC);

        // Hydration
        $userInfo = new User();
        $userInfo->setId($user["id"]);
        $userInfo->setUsername($user["username"]);
        $userInfo->setEmail($user["email"]);
        $userInfo->setDateOfBirth($user["date_of_birth"]);
        $userInfo->setPhotoUrl($user["photo"]);
        $userInfo->setCredits($user["credits"]);
        $userInfo->setRole($user["role"]);
        $userInfo->setDriversLicense($user["drivers_license"]);

        return $userInfo;
    }

    public function deleteUser(int $id)
    {
        try {
            $query = $this->pdo->prepare("DELETE FROM users WHERE id = :id;");
            $query->bindValue(":id", $id, $this->pdo::PARAM_STR);
            $query->execute();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function userpref(int $user_id)
    {
        $check = $this->pdo->prepare("SELECT COUNT(*) FROM preferences WHERE user_id = :user_id;");
        $check->bindValue(":user_id", $user_id, $this->pdo::PARAM_INT);
        $check->execute();

        $exists = $check->fetchColumn() > 0;

        $userpreferences = new Preferences();
        if ($exists) {

            $query = $this->pdo->prepare("SELECT * FROM preferences WHERE user_id = :user_id ");

            $query->bindValue(":user_id", $user_id, $this->pdo::PARAM_INT);
            $query->execute();

            $userpre = $query->fetch(\PDO::FETCH_ASSOC);

            // Hydration

            $userpreferences->setSmokingAllowed($userpre["smoking_allowed"]);
            $userpreferences->setAnimalAllowed($userpre["animal_allowed"]);
            $userpreferences->setDescription($userpre["description"]);

        }
        return $userpreferences;

    }
}
