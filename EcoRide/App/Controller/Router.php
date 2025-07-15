<?php
namespace App\Controller;

class Router
{
    public function router()
    {
        try {

            // routage
            if (isset($_GET["controller"])) {
                switch ($_GET["controller"]) {

                    case 'pages':
                        $pageRouter = new PageController();
                        $pageRouter->route();
                        break;

                    case 'car-sharing':
                        $carRoute = new CarSharingController();
                        $carRoute->route();
                        break;

                    case 'auth':
                        $authRoute = new AuthController();
                        $authRoute->route();
                        break;

                    default:
                        # code...
                        break;
                }
            } else {
                // home page
                $pageRouter = new PageController();
                $pageRouter->home();
            }
        } catch (\Exception $e) {
            $this->render('errors/default', ["error" => $e->getMessage()]);
        }
    }

    protected function render(string $path, array $params = [])
    {
        $filePath = ROOT_PATH . "/templates/" . $path . ".php";
        try {
            if (! file_exists($filePath)) {
                // generer erreure
                throw new \Exception(message: "Fichier non trouver :" . $filePath);
            } else {
                // recuperer si fichier
                extract($params);
                // extract tranforme le tableau en plusieu  r variable
                require_once $filePath;
            }
        } catch (\Exception $e) {
            $this->render('errors/default', ["error" => $e->getMessage()]);
        }

    }
}
