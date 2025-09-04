<?php
namespace Admin\App\Controller;

use App\Controller\Auth\ProfilContr;
use App\Controller\TokenCsrf;
use App\Repository\UserRepository;

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

                    case 'profil':
                        $this->profil();
                        break;

                    case 'modifProfil':
                        $this->modifProfil();
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

    public function login()
    {
        // token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();
        $this->render("auth/login", ["token" => $currentToken]);
    }

    public function profil()
    {
        // token CSRF
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();
        $userId       = $_SESSION["id"];

        if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
            $userRepo = new UserRepository();
            $user     = $userRepo->userInfo($userId);

            $profilContr = new ProfilContr();
            $preferences = $profilContr->Preferences($userId);
            $this->render("auth/profil", ["token" => $currentToken, "user" => $user, "preferences" => $preferences]);
        } else {
            header("Location: /admin/index.php?controller=auth&action=login");
        }
    }

    public function modifProfil()
    {
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
            $this->render("auth/modifProfil", ["token" => $currentToken]);
        } else {
            header("Location: /admin/index.php?controller=auth&action=login");
        }
    }
}
