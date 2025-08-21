<?php
namespace Admin\App\Repository;

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

}
