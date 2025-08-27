<?php
namespace Admin\App\Controller;

use Admin\App\Controller\Manage\ManageEmployeesContr;
use Admin\App\Controller\Manage\ManageUsersCont;
use Admin\App\Repository\Mongo\PlateformCreditsRepository;
use App\Controller\TokenCsrf;

class ManageController extends Router
{
    public function route()
    {
        try {
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case 'employees':
                        $this->employees();
                        break;

                    case 'users':
                        $this->users();
                        break;

                    case 'transactions':
                        $this->transactions();
                        break;

                    default:
                        throw new \Exception("Cette action n'existe pas" . $_GET["action"]);
                }
            } else {
                // home page
            }
        } catch (\Exception $e) {
            $this->render("errors/error", ["error" => $e->getMessage()]);
        }
    }

    public function employees()
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
                    header("Location: /admin/index.php?controller=manage&action=employees");

                } else {
                    $this->employeesAccount();
                }
            }
        }
        $totalEmployees = $userContr->CountEmployees();
        $this->render("manage/manageEmployees", ["token" => $currentToken, "employees" => $employees, "totalEmplyees" => $totalEmployees]);
    }

    public function users()
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
        $this->render("manage/manageUsers", ["token" => $currentToken, "users" => $users, "totalUsers" => $totalUsers]);
    }

    public function transactions()
    {
        $transactionRepo = new PlateformCreditsRepository();
        $transactionInfo = $transactionRepo->showTransation();

        $numTransaction = $transactionRepo->calcTransation();

        foreach ($transactionInfo as $transaction) {
            $mongotime     = $transaction["companyPayment"]["dateTransaction"];
            $mongoTimeTrip = $transaction["tripDetails"]["dateTrip"];

            $dateObjet              = $mongotime->toDateTime();
            $dateTransactionCompany = $dateObjet->format("d/m/Y");

            $dateObjetTrip = $mongoTimeTrip->toDateTime();
            $dateTrip      = $dateObjetTrip->format("d/m/Y H:i");

        }

        $this->render("manage/tripReceipts", ["transactions" => $transactionInfo, "dateCompany" => $dateTransactionCompany, "dateTrip" => $dateTrip, "numTransaction" => $numTransaction]);
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
                header("Location: /admin/index.php?controller=manage&action=users");
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
                    header("Location: /admin/index.php?controller=manage&action=employees");
                }
            }
        }
    }
}
