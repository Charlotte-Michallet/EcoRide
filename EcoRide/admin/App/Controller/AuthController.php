<?php
namespace Admin\App\Controller;

use App\Controller\Auth\ProfilContr;
use App\Controller\TokenCsrf;
use App\Repository\UserRepository;

class AuthController extends Router
{
    public function route($meta)
    {
        try {
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
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
                        throw new \Exception("Cette action n'existe pas" . $_GET["action"]);
                }
            } else {
                throw new \Exception("Acune action détéctée");
            }
        } catch (\Exception $e) {
            $this->render("errors/error", ["error" => $e->getMessage()]);
        }
    }

    public function login($meta)
    {
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();
        $this->render("auth/login", ["token" => $currentToken, "meta" => $meta["login"]]);
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
            $this->render("auth/profil", ["token" => $currentToken, "user" => $user, "preferences" => $preferences, "meta" => $meta["profil"]]);
        } else {
            header("Location: /admin/index.php?controller=auth&action=login");
        }
    }

    public function modifProfil($meta)
    {
        $tokenObj     = new TokenCsrf();
        $currentToken = $tokenObj->getGenerateToken();

        if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
            $this->render("auth/modifProfil", ["token" => $currentToken, "meta" => $meta["profilModify"]]);
        } else {
            header("Location: /admin/index.php?controller=auth&action=login");
        }
    }
}
