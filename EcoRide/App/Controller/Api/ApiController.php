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

                case 'trip':
                    $this->tripsRequests($method, $action);
                    break;

                case 'admin':
                    $this->adminRequests($method, $action);
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
                    Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour l'inscription."], 405);
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

            case 'search':
                if ($method === "POST") {
                    $showApiControl = new FindItinaryApi();
                    $showApiControl->findItinary();
                } else {
                    Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour l'inscription."], 405);
                }

                break;

            case 'participate':
                $loggin = new IsLoggedIn();
                $loggin->isLoggin();
                break;

            default:

                break;
        }
    }

    private function profilRequest($method, $action)
    {
        switch ($action) {

            case 'modifyProfil':
                if (isset($_SESSION["id"])) {
                    // if post method
                    if ($method === "POST") {
                        $ModifyApiControl = new ModifyApi();
                        $ModifyApiControl->modifyData();
                    } else {
                        Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour la création."], 405);
                    }
                    break;
                } else {
                    Router::jsonResponse(["status" => "error", "message" => "Authentification requise. Veuillez vous connecter."], 401);
                    return;
                }

            case 'addCar':
                if (isset($_SESSION["id"])) {
                    // if post method
                    if ($method === "POST") {
                        $carApiControl = new AddCarApi();
                        $carApiControl->carData();
                    } else {
                        Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour la création."], 405);
                    }
                    break;
                } else {
                    Router::jsonResponse(["status" => "error", "message" => "Authentification requise. Veuillez vous connecter."], 401);
                    return;
                }

            case 'img':
                if (isset($_SESSION["id"])) {
                    // if post method
                    if ($method === "POST") {
                        $ImgControl = new ImgApi();
                        $ImgControl->imgData();
                    } else {
                        Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour la création."], 405);
                    }
                    break;
                } else {
                    Router::jsonResponse(["status" => "error", "message" => "Authentification requise. Veuillez vous connecter."], 401);
                    return;
                }

            case 'credit':
                if (isset($_SESSION["id"])) {
                    // if post method
                    if ($method === "POST") {
                        $CreditsControl = new CreditsApi();
                        $CreditsControl->creditsData();
                    } else {
                        Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour la création."], 405);
                    }
                    break;
                } else {
                    Router::jsonResponse(["status" => "error", "message" => "Authentification requise. Veuillez vous connecter."], 401);
                    return;
                }

            default:

                break;
        }
    }

    private function tripsRequests($method, $action)
    {
        switch ($action) {

            case 'createTrip':
                if (isset($_SESSION["id"])) {
                    // if post method
                    if ($method === "POST") {
                        $ImgControl = new CreateTripApi();
                        $ImgControl->tripData();
                    } else {
                        Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour la création."], 405);
                    }

                } else {
                    Router::jsonResponse(["status" => "error", "message" => "Authentification requise. Veuillez vous connecter."], 401);
                    return;
                }

            default:

                break;
        }
    }

    private function adminRequests($method, $action)
    {
        switch ($action) {

            // case 'login':
            //     if (isset($_SESSION["id"])) {
            //         // if post method
            //         if ($method === "POST") {
            //             $loginControl = new LoginApiAdmin();
            //             $loginControl->loginAdminData();
            //         } else {
            //             Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour la création."], 405);
            //         }

            //     } else {
            //         Router::jsonResponse(["status" => "error", "message" => "Authentification requise. Veuillez vous connecter."], 401);
            //         return;
            //     }

            default:

                break;
        }
    }

}
