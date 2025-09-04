<?php
namespace Admin\App\Controller;

use App\Controller\Api\ApiController;

class Router
{
    public function router()
    {
        try {
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
                        $pageRouter->route();
                        break;

                    case 'auth':
                        $authRouter = new AuthController();
                        $authRouter->route();
                        break;

                    case 'manage':
                        $manageRouter = new ManageController();
                        $manageRouter->route();
                        break;

                    default:

                        break;
                }
            } else {
                if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
                    $pageRouter = new PageController();
                    $pageRouter->dashboard();
                } else {
                    $authRouter = new AuthController();
                    $authRouter->login();
                }
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
        $header   = ROOT_PATHS . "/templates/header.php";
        $filePath = ROOT_PATHS . "/templates/" . $path . ".php";
        $footer   = ROOT_PATHS . "/templates/footer.php";

        try {
            if (! file_exists($filePath) || ! file_exists($header) || ! file_exists($footer)) {
                // generer erreure
                throw new \Exception(message: "Fichier non trouver :" . $filePath . $header . $footer);
            } else {
                // recuperer si fichier
                extract($params);
                // extract tranforme le tableau en plusieu  r variable
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
