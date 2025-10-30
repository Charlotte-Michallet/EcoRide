<?php
namespace App\Controller\Admin;

use App\Repository\Admin\CompanyRepository;
use App\Repository\Admin\PlateformCreditsRepository;
use App\Repository\Admin\TripRepo;
use App\Repository\Admin\UsersRepo;

class DasboardContr
{
    public function statistiques()
    {
        $statistiques = [];

        $usersRepos = new UsersRepo();

        $users     = $usersRepos->totalUsers();
        $employees = $usersRepos->totalemployees();

        $tripsRepo  = new TripRepo();
        $totalTrips = $tripsRepo->totalTrips();

        $userContr      = new ManageEmployeesContr();
        $totalEmployees = $userContr->CountEmployees();

        $companyRepo  = new CompanyRepository();
        $totalcredits = $companyRepo->showcredits();

        $todayObjet = new \DateTime();
        $today      = $todayObjet->format("Y-m-d");
        $trips      = $tripsRepo->tripsPerDay($today);

        $compoanyRepo = new PlateformCreditsRepository();
        $creditsToday = $compoanyRepo->CreditsToday($todayObjet);

        $statistiques["users"]          = $users;
        $statistiques["employees"]      = $employees;
        $statistiques["totalTrips"]     = $totalTrips;
        $statistiques["totalEmployees"] = $totalEmployees;
        $statistiques["tripPerDays"]    = $trips;
        $statistiques["totalcredits"]   = $totalcredits;
        $statistiques["creditstoday"]   = $creditsToday;

        return $statistiques;
    }
}
