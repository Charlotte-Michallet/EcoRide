<?php
namespace Admin\App\Controller;

use Admin\App\Controller\Manage\ManageEmployeesContr;
use Admin\App\Repository\TripRepo;
use Admin\App\Repository\UsersRepo;

class DasboardContr
{
    public function statistiques()
    {
        $statistiques = [];

        $usersRepos = new UsersRepo();

        $users    = $usersRepos->totalUsers();
        $employes = $usersRepos->totalemployees();

        $tripsRepo  = new TripRepo();
        $totalTrips = $tripsRepo->totalTrips();

        $userContr      = new ManageEmployeesContr();
        $totalEmployees = $userContr->CountEmployees();

        $todayObjet = new \DateTime();
        $today      = $todayObjet->format("Y-m-d");
        $trips      = $tripsRepo->tripsPerDay($today);

        $statistiques["users"]          = $users;
        $statistiques["employees"]      = $employes;
        $statistiques["totalTrips"]     = $totalTrips;
        $statistiques["totalEmployees"] = $totalEmployees;
        $statistiques["tripPerDays"]    = $trips;

        return $statistiques;

    }
}
