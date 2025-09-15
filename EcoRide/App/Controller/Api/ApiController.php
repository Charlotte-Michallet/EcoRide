<?php
namespace App\Controller\Api;

use Admin\App\Controller\Api\GraphApi;
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
                    $this->adminRequests($action);
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
                Router::jsonResponse(["status" => "info", "message" => "Aucune action détectée."], 405);
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
                    Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour la recherche."], 405);
                }
                break;

            case 'filter':
                if ($method === "POST") {
                    $showApiControl = new FilterApi();
                    $showApiControl->filterData();
                } else {
                    Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour le filtre."], 405);
                }
                break;

            case 'participate':
                $loggin = new IsLoggedIn();
                $loggin->isLoggin();
                break;

            default:
                Router::jsonResponse(["status" => "info", "message" => "Aucune action détectée."], 405);
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
                        Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour la modification."], 405);
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
                        Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour cette action."], 405);
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
                        Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour le rechargement de crédits."], 405);
                    }
                    break;
                } else {
                    Router::jsonResponse(["status" => "error", "message" => "Authentification requise. Veuillez vous connecter."], 401);
                    return;
                }

            default:
                Router::jsonResponse(["status" => "info", "message" => "Aucune action détectée."], 405);
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
                        $createTripControl = new CreateTripApi();
                        $createTripControl->tripData();
                    } else {
                        Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour la création."], 405);
                    }

                } else {
                    Router::jsonResponse(["status" => "error", "message" => "Authentification requise. Veuillez vous connecter."], 401);
                    return;
                }

            case 'feedback':
                if (isset($_SESSION["id"])) {
                    // if post method
                    if ($method === "POST") {
                        $feedbackControl = new FeedbackApi();
                        $feedbackControl->feedbackData();
                    } else {
                        Router::jsonResponse(["status" => "info", "message" => "Méthode non autorisée pour l'envoie de votre avis."], 405);
                    }

                } else {
                    Router::jsonResponse(["status" => "error", "message" => "Authentification requise. Veuillez vous connecter."], 401);
                    return;
                }

            default:
                Router::jsonResponse(["status" => "info", "message" => "Aucune action détectée."], 405);
                break;
        }
    }

    private function adminRequests($action)
    {
        if ($action === "graph") {
            if (isset($_SESSION["id"])) {
                $graphContr = new GraphApi();
                $graphContr->GraphData();
            } else {
                Router::jsonResponse(["status" => "error", "message" => "Authentification requise. Veuillez vous connecter."], 401);
                return;
            }
        }
    }

}
