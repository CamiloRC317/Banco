<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();

use App\Nucleo\Router;

$router = new Router();
require __DIR__ . '/../src/Nucleo/route.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);

?>