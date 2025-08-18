<?php
namespace App\Controller\Api;

use App\Controller\Router;
use App\Repository\UserRepository;

class IsLoggedIn
{
    public function isLoggin()
    {

        $data   = file_get_contents("php://input");
        $result = json_decode($data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Router::jsonResponse(["status" => "error", "message" => "Format des données JSON invalide."], 400);
            return;
        };

        // get data from form
        $resultcredits = $result["credits"];

        // escape special caractares
        $creditString = htmlspecialchars($resultcredits);

        $creditsTrip = (int) $creditString;

        if (isset($_SESSION["id"])) {

            $id   = $_SESSION["id"];
            $role = $_SESSION["role"];

            $userRepo = new UserRepository();
            $credits  = $userRepo->usercredits($id);

            if ($role === 2 || $role === 4 || $role === 5) {
                Router::jsonResponse(["status" => "success", "message" => "credit suffisant"], 200);

            } else {
                Router::jsonResponse(["status" => "error", "message" => "Vous devais etre passager ou conducteur passager"], 403);
            }

            if ($credits < $creditsTrip) {
                Router::jsonResponse(["status" => "error", "message" => "pas assez de credit"], 402);
            } else {
                Router::jsonResponse(["status" => "success", "message" => "credit suffisant"], 200);
            }

        } else {
            Router::jsonResponse(["status" => "error", "message" => "utilisateur pas connecter"], 401);
        }
    }
}
