<?php
namespace App\Repository;

use App\Entity\User;

class UserRepository extends Repository
{
    public function userInfo(int $id)
    {

        $query = $this->pdo->prepare("SELECT u.id, u.username, u.email, u.date_of_birth, IFNULL(u.photo, ''), r.role, u.credits, IFNULL(u.drivers_license,'') FROM users u INNER JOIN roles r ON u.id_role = r.id WHERE u.id = :id;");

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
        $userInfo->setPhotoUrl($user["photo"] ?? "");
        $userInfo->setCredits($user["credits"]);
        $userInfo->setCredits($user["credits"]);
        $userInfo->setRole($user["role"]);
        $userInfo->setDriversLicense($user["drivers_license"] ?? "");

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
}
