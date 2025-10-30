<?php
namespace App\Controller\Admin;

use App\Repository\Admin\UsersRepo;

class ManageUsersCont
{
    public function showUsers()
    {
        $usersRepo = new UsersRepo();
        $allUsers  = $usersRepo->allUsers();

        return $allUsers;
    }

    public function CountUsers()
    {
        $usersRepo = new UsersRepo();
        $allUsers  = $usersRepo->totalUsers();

        return $allUsers;
    }

    public function updateUsers($account, $id)
    {
        $usersRepo = new UsersRepo();
        $succes    = $usersRepo->updateUsers($account, $id);
        return $succes;
    }

    public function deleteEmployee($id)
    {
        $usersRepo = new UsersRepo();
        $usersRepo->deleteEmployee($id);
    }
}
