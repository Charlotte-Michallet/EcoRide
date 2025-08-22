<?php
namespace Admin\App\Controller\Manage;

use Admin\App\Repository\UsersRepo;

class ManageEmployeesContr
{
    public function showEmployees()
    {
        $usersRepo    = new UsersRepo();
        $allEmployees = $usersRepo->allemployees();

        return $allEmployees;
    }

    public function CountEmployees()
    {
        $usersRepo    = new UsersRepo();
        $allEmployees = $usersRepo->totalemployees();

        return $allEmployees;
    }
}
