<?php
namespace Admin\App\Controller;

use App\Controller\TokenCsrf;

class AuthController extends Router
{
    public function route()
    {
        try {
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case 'login':
                        $this->login();
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

    public function login()
    {
        // token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();
        $this->render("auth/login", ["token" => $currentToken]);
    }
}
