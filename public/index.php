<?php

require_once '../vendor/autoload.php';

use App\Exceptions\NotFoundException;
use App\Core\Router;
use Dotenv\Dotenv;

// Load .env file content in to environment vars
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// echo '<pre>';
// var_dump('DotEnv file: ', $_ENV['TEST_KEY'], $_ENV['SECRET_KEY']);
// echo '</pre>';

// echo '<h1>Redirected to PUBLIC folder</h1>';


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
