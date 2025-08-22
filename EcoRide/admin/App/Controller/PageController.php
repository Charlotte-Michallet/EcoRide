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

                    case 'contact':
                        $this->contact();
                        break;

                    case 'legal':
                        $this->legal();
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

    public function dashboard()
    {
        // token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();
        // $id           = $_SESSION["id"];

        $dashboardCrontr = new DasboardContr();
        $statistiques    = $dashboardCrontr->statistiques();

        $userContr = new ManageEmployeesContr();
        $employees = $userContr->showEmployees();

        $this->render("pages/dashboard", ["token" => $currentToken, "statistiques" => $statistiques, "employees" => $employees]);
    }

    protected function contact()
    {
        $this->render("pages/contact");
    }

    protected function legal()
    {
        $this->render("pages/legals");
    }
}
