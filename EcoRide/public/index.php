<?php
ob_start();

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../config/configSession.php";

// cont for root path
define("ROOT_PATH", dirname(__DIR__));
// var_dump(ROOT_PATH);

use App\Controller\Router;

$router = new Router();
$router->router();

ob_end_flush();
