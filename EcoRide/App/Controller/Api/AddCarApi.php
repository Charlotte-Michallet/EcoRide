<?php
namespace App\Controller\Api;

use App\Controller\Router;
use App\Controller\TokenCsrf;

class AddCarApi
{
    public function carData()
    {

        $data   = file_get_contents("php://input");
        $result = json_decode($data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Router::jsonResponse(["status" => "error", "message" => "Format des données JSON invalide."], 400);
            return;
        }

        $user_id = $_SESSION["id"];

        // if post method
        if ($_SERVER["REQUEST_METHOD"] === "POST" && (isset($_POST["newCar"]) && $_POST["newCar"])) {

            // get data from form
            $submittedToken      = htmlspecialchars($_POST["token_csrf"]);
            $brand               = htmlspecialchars(trim($_POST["brandCreate"]));
            $model               = htmlspecialchars(trim($_POST["modelCreate"]));
            $energy_type         = htmlspecialchars(trim($_POST["energyType"]));
            $numplate            = htmlspecialchars(trim($_POST["nbPlate"]));
            $num_seats_string    = htmlspecialchars(trim($_POST["numSpaces"]));
            $first_register_date = htmlspecialchars(trim($_POST["dateNbPlate"]));
            $color               = htmlspecialchars(trim($_POST["colorCreate"]));
            $num_seats           = (int) $num_seats_string;
            // Check token CSRF
            $token   = new TokenCsrf();
            $isValid = $token->validateToken($submittedToken);

            if ($isValid) {

                // new car
                // $carContr = new CarContr($brand, $model, $energy_type, $num_seats, $numplate, $first_register_date, $color, $user_id);
                // $carContr->checkImputs();
            }
        }
    }
}
