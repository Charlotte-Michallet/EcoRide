<?php
namespace Admin\App\Controller;

use App\Controller\Api\ApiController;

class Router
{
    protected $meta;

    public function router()
    {
        $this->meta = require_once ROOT_PATHS . "/config/meta.php";
        $meta       = $this->meta;
        try {
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

                    case 'auth':
                        $authRouter = new AuthController();
                        $authRouter->route($meta);
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
                if (isset($_SESSION["id"]) && $_SESSION["role"] === 1) {
                    $pageRouter = new PageController();
                    $pageRouter->dashboard($meta);
                } else {
                    $authRouter = new AuthController();
                    $authRouter->login($meta);
                }
            }
        } catch (\Exception $e) {
            if (isset($_GET["controller"]) && $_GET["controller"] === "api") {
                self::jsonResponse(["status" => "error", "message" => "Erreur interne du serveur API : " . $e->getMessage()], 500);

            } else {
                $this->render("errors/error", ["error" => $e->getMessage()]);
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
                throw new \Exception(message: "Fichier non trouvé :" . $filePath . $header . $footer);
            } else {
                extract($params);

                require_once $header;
                require_once $filePath;
                require_once $footer;
            }
        } catch (\Exception $e) {
            $this->render("errors/error", ["error" => $e->getMessage()]);
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
