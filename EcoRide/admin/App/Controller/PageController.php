<?php
namespace Admin\App\Controller;

use Admin\App\Controller\Manage\ManageEmployeesContr;
use App\Controller\TokenCsrf;

class PageController extends Router
{
    public function route()
    {
        try {
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case 'dashboard':
                        $this->dashboard();
                        break;

                    case 'legal':
                        $this->legal();
                        break;

                    default:
                        throw new \Exception("Cette action n'existe pas" . $_GET["action"]);
                }
            } else {
                if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
                    $pageRouter = new PageController();
                    $pageRouter->dashboard();
                } else {
                    $authRouter = new AuthController();
                    $authRouter->login();
                }
            }
        } catch (\Exception $e) {
            $this->render("errors/error", ["error" => $e->getMessage()]);
        }
    }

    public function dashboard()
    {
        // token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        $dashboardCrontr = new DasboardContr();
        $statistiques    = $dashboardCrontr->statistiques();

        $userContr = new ManageEmployeesContr();
        $employees = $userContr->showEmployees();

        if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
            $this->render("pages/dashboard", ["token" => $currentToken, "statistiques" => $statistiques, "employees" => $employees]);
        } else {
            header("Location: /admin/index.php?controller=auth&action=login");
        }
    }

    protected function legal()
    {
        $this->render("pages/legals");
    }
}
