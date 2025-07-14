<?php
namespace App\Controller;

class Router
{
    public function router()
    {
        try {
            if (isset($_GET["controller"])) {
                switch ($_GET["controller"]) {
                    case 'pages':
                        # code...
                        break;

                    case 'car-sharing':
                        # code...
                        break;

                    case 'auth':
                        # code...
                        break;

                    case 'contact':
                        # code...
                        break;

                    default:
                        # code...
                        break;
                }
            } else {
                // home page
            }
        } catch (\Exception $e) {
            // $this->render('errors/default', ["error" => $e->getMessage()]);
        }
    }

    // protected function render(string $path, array $params = [])
    // {
    //     // $filePath = _ROOTPATH_ . "/templates/" . $path . ".php";
    //     try {
    //         if (! file_exists($filePath)) {
    //             // generer erreure
    //             throw new \Exception(message: "Fichier non trouver :" . $filePath);
    //         } else {
    //             // recuperer si fichier
    //             extract($params);
    //             // extract tranforme le tableau en plusieu  r variable
    //             require_once $filePath;
    //         }
    //     } catch (\Exception $e) {
    //         $this->render('errors/default', ["error" => $e->getMessage()]);
    //     }

    // }
}
