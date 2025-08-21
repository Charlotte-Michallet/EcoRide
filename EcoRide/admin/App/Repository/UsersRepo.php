<?php
namespace Admin\App\Repository;

use App\Entity\User;
use App\Repository\Repository;

class UsersRepo extends Repository
{
    public function totalUsers()
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE id_role != 1 AND id_role != 2;");
        $query->execute();

        $totalUsers = $query->fetchColumn();

        return $totalUsers;
    }

    public function totalemployees()
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE id_role = 2;");
        $query->execute();

        $totalemployees = $query->fetchColumn();

        return $totalemployees;
    }

    public function allemployees()
    {
        $query = $this->pdo->prepare("SELECT u.id, u.username, u.email, u.photo, r.role, u.credits, u.active FROM users u INNER JOIN roles r ON id_role = r.id WHERE id_role = 2;");
        $query->execute();

        $Users    = $query->fetchAll(\PDO::FETCH_ASSOC);
        $allUsers = [];

        foreach ($Users as $user) {
            // Hydration
            $userInfo = new User();
            $userInfo->setId($user["id"]);
            $userInfo->setUsername($user["username"]);
            $userInfo->setEmail($user["email"]);
            $userInfo->setPhotoUrl($user["photo"]);
            $userInfo->setCredits($user["credits"]);
            $userInfo->setRole($user["role"]);
            $userInfo->setActive($user["active"]);
            $allUsers[] = $userInfo;
        }
        return $allUsers;
    }

    public function allUsers()
    {
        $query = $this->pdo->prepare("SELECT u.id, u.username, u.email, u.photo, r.role, u.notes, u.active FROM users u INNER JOIN roles r ON id_role = r.id WHERE id_role != 2 AND id_role != 1;");
        $query->execute();

        $Users    = $query->fetchAll(\PDO::FETCH_ASSOC);
        $allUsers = [];

        foreach ($Users as $user) {
            // Hydration
            $userInfo = new User();
            $userInfo->setId($user["id"]);
            $userInfo->setUsername($user["username"]);
            $userInfo->setEmail($user["email"]);
            $userInfo->setPhotoUrl($user["photo"]);
            // $userInfo->setNotes($user["notes"]);
            $userInfo->setRole($user["role"]);
            $userInfo->setActive($user["active"]);
            $allUsers[] = $userInfo;
        }
        return $allUsers;
    }

    public function updateUsers($account, $id)
    {
        try {
            $query = $this->pdo->prepare("UPDATE users SET active = :active WHERE id = :id;");

            $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
            $query->bindValue(":active", $account, $this->pdo::PARAM_STR);
            $query->execute();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function deleteEmployee($id)
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
