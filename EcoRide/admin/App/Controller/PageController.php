<?php
namespace Admin\App\Controller;

use Admin\App\Controller\Manage\ManageEmployeesContr;
use App\Controller\TokenCsrf;

class PageController extends Router
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

                    default:
                        throw new \Exception("Cette action n'existe pas :" . $_GET["action"]);
                }
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch (\Exception $e) {
            $this->render("errors/error", ["error" => $e->getMessage()]);
        }
    }

    public function dashboard($meta)
    {
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        $dashboardCrontr = new DasboardContr();
        $statistiques    = $dashboardCrontr->statistiques();

        $userContr = new ManageEmployeesContr();
        $employees = $userContr->showEmployees();

        if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
            $this->render("pages/dashboard", ["token" => $currentToken, "statistiques" => $statistiques, "employees" => $employees, "meta" => $meta["dashboard"]]);
        } else {
            header("Location: /admin/index.php?controller=auth&action=login");
            exit();
        }
    }

    protected function legal($meta)
    {
        $this->render("pages/legals", ["meta" => $meta["legals"]]);
    }
}
