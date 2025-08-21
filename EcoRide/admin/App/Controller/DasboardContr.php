<?php
namespace Admin\App\Controller;

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

        $statistiques["users"]      = $users;
        $statistiques["employees"]  = $employes;
        $statistiques["totalTrips"] = $totalTrips;

        return $statistiques;

    }
}
