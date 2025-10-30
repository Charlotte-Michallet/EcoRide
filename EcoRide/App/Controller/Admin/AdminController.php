<?php
namespace App\Controller\Admin;

use App\Controller\Router;
use App\Controller\TokenCsrf;

class AdminController extends Router
{
    public function route($meta)
    {
        try {
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case 'dashboard':
                        $this->dashboard($meta);
                        break;

                    case 'legal':
                        $this->legal($meta);
                        break;

                    case 'employees':
                        $this->employees($meta);
                        break;

                    case 'users':
                        $this->users($meta);
                        break;

                    case 'transactions':
                        $this->transactions($meta);
                        break;

                    case 'login':
                        $this->login($meta);
                        break;

                    case 'profil':
                        $this->profil($meta);
                        break;

                    case 'modifProfil':
                        $this->modifProfil($meta);
                        break;

                    default:
                        throw new \Exception("Cette action n'existe pas :" . $_GET["action"]);
                }
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch (\Exception $e) {
            $this->renderadmin("errors/default", ["error" => $e->getMessage()]);
        }
    }

    // Pages
    public function dashboard($meta)
    {
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        // $dashboardCrontr = new DasboardContr();
        // $statistiques    = $dashboardCrontr->statistiques();

        // $userContr = new ManageEmployeesContr();
        // $employees = $userContr->showEmployees();

        if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
            $this->renderadmin("admin/dashboard", ["token" => $currentToken,
                // "statistiques" => $statistiques, "employees" => $employees,
                "meta"                                         => $meta["dashboard_admin"]]);
        } else {
            header("Location: /index.php?controller=admin&action=login");
            exit();
        }
    }

    protected function legal($meta)
    {
        if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
            $this->renderadmin("pages/legals", ["meta" => $meta["legal"]]);
        } else {
            header("Location: /index.php?controller=admin&action=login");
            exit();
        }
    }

    public function employees($meta)
    {
        // token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        //     $userContr = new ManageEmployeesContr();
        //     $employees = $userContr->showEmployees();

        //     if ($_SERVER["REQUEST_METHOD"] === "POST") {

        //         $resultsubmittedToken = $_POST["token"];
        //         $submittedToken       = htmlspecialchars($resultsubmittedToken);

        //         $token   = new TokenCsrf();
        //         $isValid = $token->validateToken($submittedToken);

        //         if ($isValid) {
        //             if ((isset($_POST["delete"]) && $_POST["delete"])) {

        //                 $resultsubmittedToken = $_POST["token"];
        //                 $submittedToken       = htmlspecialchars($resultsubmittedToken);

        //                 $resultsidsubmitted = $_POST["id"];
        //                 $idsubmitted        = htmlspecialchars($resultsidsubmitted);

        //                 $userContr = new ManageUsersCont();
        //                 $userContr->deleteEmployee($idsubmitted);
        //                 header("Location: /admin/index.php?controller=manage&action=employees");
        //                 exit();

        //             } else {
        //                 $this->employeesAccount();
        //             }
        //         }
        //     }
        //     $totalEmployees = $userContr->CountEmployees();
        $this->renderadmin("admin/manageEmployees", ["token" => $currentToken,
            // "employees" => $employees, "totalEmplyees" => $totalEmployees,
            "meta"                                               => $meta["employee_admin"]]);
    }

    public function users($meta)
    {
        // token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        //     $userContr = new ManageUsersCont();
        //     $users     = $userContr->showUsers();

        //     if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //         $this->usersAccount();
        //     }

        //     $totalUsers = $userContr->CountUsers();
        //     $this->renderadmin("manage/manageUsers", ["token" => $currentToken, "users" => $users, "totalUsers" => $totalUsers, "meta" => $meta["users"]]);
    }

    public function login($meta)
    {
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();
        $this->renderadmin("admin/login", ["token" => $currentToken, "meta" => $meta["login_admin"]]);
    }

    public function profil($meta)
    {
        $tokenObj = new TokenCsrf();
        // $currentToken = $tokenObj->getGenerateToken();
        // $userId       = $_SESSION["id"];

        // if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
        //     $userRepo = new UserRepository();
        //     $user     = $userRepo->userInfo($userId);

        //     $profilContr = new ProfilContr();
        //     $preferences = $profilContr->Preferences($userId);
        //     $this->render("auth/profil", ["token" => $currentToken, "user" => $user, "preferences" => $preferences, "meta" => $meta["profil"]]);
        // } else {
        header("Location: /index.php?controller=admin&action=login");
        exit();
        // }
    }

    public function modifProfil($meta)
    {
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        // if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
        //     $this->render("auth/modifProfil", ["token" => $currentToken, "meta" => $meta["profilModify"]]);
        // } else {
        header("Location: /index.php?controller=admin&action=login");
        exit();
        // }
    }

    // Methods

    public function transactions($meta)
    {
        // $transactionRepo = new PlateformCreditsRepository();
        // $transactionInfo = $transactionRepo->showTransation();

        // $numTransaction = $transactionRepo->calcTransation();

        // foreach ($transactionInfo as $transaction) {
        //     $mongotime     = $transaction["companyPayment"]["dateTransaction"];
        //     $mongoTimeTrip = $transaction["tripDetails"]["dateTrip"];

        //     $dateObjet              = $mongotime->toDateTime();
        //     $dateTransactionCompany = $dateObjet->format("d/m/Y");

        //     $dateObjetTrip = $mongoTimeTrip->toDateTime();
        //     $dateTrip      = $dateObjetTrip->format("d/m/Y H:i");
        // }

        // $this->render("manage/tripReceipts", ["transactions" => $transactionInfo, "dateCompany" => $dateTransactionCompany, "dateTrip" => $dateTrip, "numTransaction" => $numTransaction, "meta" => $meta["transaction"]]);
    }

    public function usersAccount()
    {
        // $account            = null;
        // $resultsidsubmitted = $_POST["id"];
        // $idsubmitted        = htmlspecialchars($resultsidsubmitted);

        // if (isset($_POST["activate"]) && $_POST["activate"]) {
        //     $account = "Actif";
        // }

        // if (isset($_POST["suspend"]) && $_POST["suspend"]) {
        //     $account = "Suspendu";
        // }

        // if ($account !== null) {
        //     $userContr = new ManageUsersCont();
        //     $success   = $userContr->updateUsers($account, $idsubmitted);

        //     if ($success === true) {
        //         header("Location: /admin/index.php?controller=manage&action=users");
        //         exit();
        //     }
        // }

    }

    public function employeesAccount()
    {
        // $resultsubmittedToken = $_POST["token"];
        // $submittedToken       = htmlspecialchars($resultsubmittedToken);

        $token = new TokenCsrf();
        // $isValid = $token->validateToken($submittedToken);

        // if ($isValid) {
        //     $resultsidsubmitted = $_POST["id"];
        //     $idsubmitted        = htmlspecialchars($resultsidsubmitted);
        //     $account            = null;

        //     if (isset($_POST["activate"]) && $_POST["activate"]) {
        //         $account = "Actif";
        //     }

        //     if (isset($_POST["suspend"]) && $_POST["suspend"]) {
        //         $account = "Suspendu";
        //     }

        //     if ($account !== null) {
        //         $userContr = new ManageUsersCont();
        //         $success   = $userContr->updateUsers($account, $idsubmitted);

        //         if ($success === true) {
        //             header("Location: /admin/index.php?controller=manage&action=employees");
        //             exit();
        //         }
        //     }
        // }
    }
}
