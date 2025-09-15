<?php
namespace App\Controller;

use App\Controller\Api\ApiController;

class Router
{
    protected $meta;
    public function router()
    {
        try {
            $this->meta = require_once ROOT_PATH . "/config/meta.php";
            $meta       = $this->meta;

            // routage for redirecting pages
            if (isset($_GET["controller"])) {

                // if controller for API
                if ($_GET["controller"] === "api") {
                    $apiController = new ApiController();
                    $apiController->apiRoute();
                    return;
                }

                switch ($_GET["controller"]) {

                    case 'pages':
                        $pageRouter = new PageController();
                        $pageRouter->route($meta);
                        break;

                    case 'car-sharing':
                        $carRouter = new CarSharingController();
                        $carRouter->route($meta);
                        break;

                    case 'auth':
                        $authRouter = new AuthController();
                        $authRouter->route($meta);
                        break;

                    case 'trips':
                        $pageRouter = new TripsController();
                        $pageRouter->route($meta);
                        break;

                    case 'manage':
                        $manageRouter = new ManageController();
                        $manageRouter->route($meta);
                        break;

                    default:
                        $this->render("errors/error", ["error" => $e->getMessage()]);
                        break;
                }
            } else {
                // home page
                $pageRouter = new PageController();
                $pageRouter->home($meta);
            }
        } catch (\Exception $e) {

            if (isset($_GET["controller"]) && $_GET["controller"] === "api") {
                self::jsonResponse(["status" => "error", "message" => "Erreur interne du serveur API: " . $e->getMessage()], 500);

            } else {
                $this->render("errors/default", ["error" => $e->getMessage()]);
            }
        }
    }

    protected function render(string $path, array $params = [])
    {
        $header   = ROOT_PATH . "/templates/header.php";
        $filePath = ROOT_PATH . "/templates/" . $path . ".php";
        $footer   = ROOT_PATH . "/templates/footer.php";

        try {
            if (! file_exists($filePath) || ! file_exists($header) || ! file_exists($footer)) {
                // generer erreure
                throw new \Exception(message: "Fichier non trouver :" . $filePath . $header . $footer);
            } else {
                // recuperer si fichier
                extract($params);

                require_once $header;
                require_once $filePath;
                require_once $footer;
            }
        } catch (\Exception $e) {
            $this->render("errors/default", ["error" => $e->getMessage()]);
        }
    }

    public static function jsonResponse(array $data, int $statusCode = 200)
    {
        http_response_code($statusCode);
        header("Content-Type: application/json");
        echo json_encode($data);
        exit();
    }
}
