<?php
namespace Admin\App\Controller;

class ManageController extends Router
{
    public function route()
    {
        try {
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case 'dashboard':
                        // $this->dashboard();
                        break;

                    // case 'contact':
                    //     $this->contact();
                    //     break;

                    // case 'legal':
                    //     $this->legal();
                    //     break;

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
}
