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

                    case 'trips':
                        $pageRouter = new TripsController();
                        $pageRouter->route();
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
                // extract tranforme le tableau en plusieu  r variable
                require_once $header;
                require_once $filePath;
                require_once $footer;

            }
        } catch (\Exception $e) {
            $this->render('errors/default', ["error" => $e->getMessage()]);
        }
    }
}
