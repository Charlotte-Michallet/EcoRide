<?php
namespace App\Controller\Admin;

use App\Repository\Admin\UsersRepo;

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
