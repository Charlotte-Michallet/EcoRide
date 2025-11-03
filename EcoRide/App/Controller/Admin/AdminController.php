<?php
namespace App\Controller\Admin;

use App\Controller\Auth\ProfilContr;
use App\Controller\Router;
use App\Controller\TokenCsrf;
use App\Repository\Admin\PlateformCreditsRepository;
use App\Repository\UserRepository;

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

        $dashboardCrontr = new DasboardContr();
        $statistiques    = $dashboardCrontr->statistiques();

        $userContr = new ManageEmployeesContr();
        $employees = $userContr->showEmployees();

        if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
            $this->renderadmin("admin/dashboard", ["token" => $currentToken, "statistiques" => $statistiques, "employees" => $employees, "meta" => $meta["dashboard_admin"]]);
        } else {
            header("Location: /index.php?controller=admin&action=login");
            exit();
        }
    }

    protected function legal($meta)
    {
        if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
            $this->renderadmin("pages/legals", ["meta" => $meta["legals_admin"]]);
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

        $userContr = new ManageEmployeesContr();
        $employees = $userContr->showEmployees();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $resultsubmittedToken = $_POST["token"];
            $submittedToken       = htmlspecialchars($resultsubmittedToken);

            $token   = new TokenCsrf();
            $isValid = $token->validateToken($submittedToken);

            if ($isValid) {
                if ((isset($_POST["delete"]) && $_POST["delete"])) {

                    $resultsubmittedToken = $_POST["token"];
                    $submittedToken       = htmlspecialchars($resultsubmittedToken);

                    $resultsidsubmitted = $_POST["id"];
                    $idsubmitted        = htmlspecialchars($resultsidsubmitted);

                    $userContr = new ManageUsersCont();
                    $userContr->deleteEmployee($idsubmitted);
                    header("Location: /index.php?controller=admin&action=employees");
                    exit();

                } else {
                    $this->employeesAccount();
                }
            }
        }

        $totalEmployees = $userContr->CountEmployees();

        if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {

            $this->renderadmin("admin/manageEmployees", ["token" => $currentToken, "employees" => $employees, "totalEmplyees" => $totalEmployees, "meta" => $meta["employee_admin"]]);
        } else {
            header("Location: /index.php?controller=admin&action=login");
            exit();
        }

    }

    public function users($meta)
    {
        // token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        $userContr = new ManageUsersCont();
        $users     = $userContr->showUsers();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->usersAccount();
        }
        $totalUsers = $userContr->CountUsers();

        if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
            $this->renderadmin("admin/manageUsers", ["token" => $currentToken, "users" => $users, "totalUsers" => $totalUsers, "meta" => $meta["users_admin"]]);
        } else {
            header("Location: /index.php?controller=admin&action=login");
            exit();
        }
    }

    public function login($meta)
    {
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();
        $this->renderadmin("admin/login", ["token" => $currentToken, "meta" => $meta["login_admin"]]);
    }

    public function profil($meta)
    {
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();
        $userId       = $_SESSION["id"];

        if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
            $userRepo = new UserRepository();
            $user     = $userRepo->userInfo($userId);

            $profilContr = new ProfilContr();
            $preferences = $profilContr->Preferences($userId);
            $this->renderadmin("admin/profil", ["token" => $currentToken, "user" => $user, "preferences" => $preferences, "meta" => $meta["profil_admin"]]);
        } else {
            header("Location: /index.php?controller=admin&action=login");
            exit();
        }
    }

    public function modifProfil($meta)
    {
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
            $this->renderadmin("admin/modifProfil", ["token" => $currentToken, "meta" => $meta["profilModify_admin"]]);
        } else {
            header("Location: /index.php?controller=admin&action=login");
            exit();
        }
    }

    // Methods

    public function transactions($meta)
    {
        $transactionRepo = new PlateformCreditsRepository();
        $transactionInfo = $transactionRepo->showTransation();

        $numTransaction = $transactionRepo->calcTransation();

        foreach ($transactionInfo as $key => $transaction) {
            // date transaction
            $mongotime = $transaction["companyPayment"]["dateTransaction"];
            $dateObjet = $mongotime->toDateTime();

            $transactionInfo[$key]["dateTransactionComapnyFormatted"] = $dateObjet->format("d/m/Y");

            // date trip
            $mongoTimeTrip = $transaction["tripDetails"]["dateTrip"];
            $dateObjetTrip = $mongoTimeTrip->toDateTime();

            $transactionInfo[$key]["dateTripFormatted"] = $dateObjetTrip->format("d/m/Y H:i");
        }

        if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
            $this->renderadmin("admin/tripReceipts", ["transactions" => $transactionInfo, "numTransaction" => $numTransaction, "meta" => $meta["transaction_admin"]]);
        } else {
            header("Location: /index.php?controller=admin&action=login");
            exit();
        }

    }

    public function usersAccount()
    {
        $account            = null;
        $resultsidsubmitted = $_POST["id"];
        $idsubmitted        = htmlspecialchars($resultsidsubmitted);

        if (isset($_POST["activate"]) && $_POST["activate"]) {
            $account = "Actif";
        }

        if (isset($_POST["suspend"]) && $_POST["suspend"]) {
            $account = "Suspendu";
        }

        if ($account !== null) {
            $userContr = new ManageUsersCont();
            $success   = $userContr->updateUsers($account, $idsubmitted);

            if ($success === true) {
                header("Location: /index.php?controller=admin&action=users");
                exit();
            }
        }

    }

    public function employeesAccount()
    {
        $resultsubmittedToken = $_POST["token"];
        $submittedToken       = htmlspecialchars($resultsubmittedToken);

        $token   = new TokenCsrf();
        $isValid = $token->validateToken($submittedToken);

        if ($isValid) {
            $resultsidsubmitted = $_POST["id"];
            $idsubmitted        = htmlspecialchars($resultsidsubmitted);
            $account            = null;

            if (isset($_POST["activate"]) && $_POST["activate"]) {
                $account = "Actif";
            }

            if (isset($_POST["suspend"]) && $_POST["suspend"]) {
                $account = "Suspendu";
            }

            if ($account !== null) {
                $userContr = new ManageUsersCont();
                $success   = $userContr->updateUsers($account, $idsubmitted);

                if ($success === true) {
                    header("Location: /index.php?controller=admin&action=employees");
                    exit();
                }
            }
        }
    }
}
