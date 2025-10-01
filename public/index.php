<?php

require_once '../vendor/autoload.php';

use App\Exceptions\NotFoundException;
use App\Core\Router;
use App\Core\DBH;
use Dotenv\Dotenv;

// Load .env file content in to environment vars
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// echo '<pre>';
// var_dump($_ENV);
// echo '</pre>';
// die();


try {
    $conn = new DBH();
    $conn->get_connection();
    echo 'Connection successful';
} catch (\PDOException $e) {
    echo 'Error database connection: ' . $e->getMessage();
}

// echo '<pre>';
// var_dump($_ENV);
// echo '</pre>';

// Routing
$url = ltrim($_SERVER['REQUEST_URI'], '\/');


$route = new Router();
$route->add('', ['controller' => 'home', 'action' => 'index']);
$route->add('{controller}/{action}');
$route->add('{controller}/{id:\d+}/{action}');
$route->add('{controller}/{id:\d+}/{action}/{cid:\d+}');

try {
    $route->dispatch($url);
} catch (NotFoundException $e) {
    \App\Controllers\Error::missing($e);
} catch (Exception $e) {
    echo '<pre>';
    var_dump($e->getMessage());
    echo '</pre>';
}
