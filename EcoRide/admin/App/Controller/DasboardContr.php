<?php
namespace Admin\App\Controller;

use Admin\App\Controller\Manage\ManageEmployeesContr;
use Admin\App\Repository\CompanyRepository;
use Admin\App\Repository\Mongo\PlateformCreditsRepository;
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

        $companyRepo  = new CompanyRepository();
        $totalcredits = $companyRepo->showcredits();

        $todayObjet = new \DateTime();
        $today      = $todayObjet->format("Y-m-d");
        $trips      = $tripsRepo->tripsPerDay($today);

        $compoanyRepo = new PlateformCreditsRepository();
        $creditsToday = $compoanyRepo->CreditsToday($todayObjet);

        $statistiques["users"]          = $users;
        $statistiques["employees"]      = $employes;
        $statistiques["totalTrips"]     = $totalTrips;
        $statistiques["totalEmployees"] = $totalEmployees;
        $statistiques["tripPerDays"]    = $trips;
        $statistiques["totalcredits"]   = $totalcredits;
        $statistiques["creditstoday"]   = $creditsToday;

        return $statistiques;

    }
}
