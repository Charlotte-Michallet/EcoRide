<?php
namespace App\Controller\Api;

use App\Controller\Router;

class ApiController
{
    public function apiRoute()
    {
        header("Content-Type: application/json");

        $action   = $_GET["action"] ?? null;
        $resource = $_GET["resource"] ?? null;
        $method   = $_SERVER["REQUEST_METHOD"];

        try {
            switch ($resource) {

                case 'auth':
                    $this->AuthRequest($method, $action);
                    break;

                case 'search':
                    $this->searchRequest($method, $action);
                    break;

                case 'profil':
                    $this->profilRequest($method, $action);
                    break;

                default:
                    Router::jsonResponse(["status" => "error", "message" => "Ressource API non reconnue."], 404);
                    break;
            }

        } catch (\Exception $e) {
            Router::jsonResponse(["status" => "error", "message" => "Action d'authentification API non valide."], 400);
        }

    }

    private function AuthRequest(string $method, string $action)
    {
        switch ($action) {

            case "register":
                if ($method === "POST") {
                    $registerApiControl = new RegisterApi();
                    $registerApiControl->registerData();
                } else {
                    Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour la connexion."], 405);
                }
                break;

            case "login":
                if ($method === "POST") {
                    $loginApiControl = new LoginApi();
                    $loginApiControl->loginData();
                } else {
                    Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour la connexion."], 405);
                }

                break;

            default:

                break;
        }

    }

    private function searchRequest($method, $action)
    {
        switch ($action) {

            case 'auth':

                break;

            case 'search':

                break;

            case 'profil':

                break;

            default:

                break;
        }
    }

    private function profilRequest($method, $action)
    {
        switch ($action) {

            case 'modifyProfil':

                break;

            case 'addCar':
                if ($method === "POST") {
                    $carApiControl = new AddCarApi();
                    $carApiControl->carData();
                } else {
                    Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour la connexion."], 405);
                }

                break;

            case 'profil':

                break;

            default:

                break;
        }
    }

}
