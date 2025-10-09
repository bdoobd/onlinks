<?php

require_once '../vendor/autoload.php';

use App\Core\App;
use App\Exceptions\NotFoundException;
use App\Core\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$app = new App(dirname(__DIR__));

echo '<pre>';
var_dump($app->showURI());
echo '</pre>';
// die();

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
