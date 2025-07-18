<?php

namespace App\Controller;

class PageController extends Router
{
    public function route()
    {
        try {
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case 'home':
                        $this->home();
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
            $this->render('errors/default', ["error" => $e->getMessage()]);
        }
    }

    protected function home()
    {
        $this->render("pages/home");
    }

    protected function legal()
    {
        $this->render("pages/legals");
    }

    protected function contact()
    {
        $this->render("pages/contact");
    }
}
