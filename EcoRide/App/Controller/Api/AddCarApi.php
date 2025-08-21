<?php
namespace App\Controller\Api;

use App\Controller\Car\CarContr;
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

        // get data from form
        $resultsubmittedToken      = $result["token"];
        $resultbrand               = $result["brand"];
        $resultmodel               = $result["model"];
        $resultenergy_type         = $result["energy"];
        $resultnumplate            = $result["numPlate"];
        $resultnum_seats_string    = $result["seats"];
        $resultfirst_register_date = $result["dateRegister"];
        $resultcolor               = $result["color"];

        // Sanitize data
        $submittedToken      = htmlspecialchars($resultsubmittedToken);
        $brand               = htmlspecialchars(trim($resultbrand));
        $model               = htmlspecialchars(trim($resultmodel));
        $energy_type         = htmlspecialchars(trim($resultenergy_type));
        $numplate            = htmlspecialchars(trim($resultnumplate));
        $num_seats_string    = htmlspecialchars(trim($resultnum_seats_string));
        $first_register_date = htmlspecialchars(trim($resultfirst_register_date));
        $color               = htmlspecialchars(trim($resultcolor));

        $num_seats = (int) $num_seats_string;

        // Check token CSRF
        $token   = new TokenCsrf();
        $isValid = $token->validateToken($submittedToken);

        if ($isValid) {

            $user_id = $_SESSION["id"];
            // new car
            $carContr = new CarContr($brand, $model, $energy_type, $num_seats, $numplate, $first_register_date, $color, $user_id);
            $carError = $carContr->checkImputs();

            if (! empty($carError)) {
                Router::jsonResponse(["status" => "error", "message" => $carError[0]], 400);
            } else {
                Router::jsonResponse(["status" => "success", "message" => "Voiture ajouté"], 200);
                return;
            }

        } else {
            Router::jsonResponse(["status" => "error", "message" => "Token CSRF invalide."], 403);
            return;
        }
    }
}
