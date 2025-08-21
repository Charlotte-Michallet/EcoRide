<?php
ob_start();

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../config/configSession.php";

// cont for root path
define("ROOT_PATHS", __DIR__);

use Admin\App\Controller\Router;
use App\Controller\TokenCsrf;

$csrf_generateur = new TokenCsrf;
$token           = $csrf_generateur->getGenerateToken();

$router = new Router;
$router->router();

ob_end_flush();
