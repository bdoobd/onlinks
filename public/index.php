<?php

require_once '../vendor/autoload.php';

use App\Controllers\Home;
use App\Exceptions\NotFoundException;
use App\Core\Router;

echo '<h1>Redirected to PUBLIC folder</h1>';


// Routing
$url = ltrim($_SERVER['REQUEST_URI'], '\/');


$route = new Router();
$route->add('', ['controller' => 'home', 'action' => 'index']);
$route->add('{controller}/{action}');
$route->add('{controller}/{id:\d+}/{action}');
$route->add('{controller}/{id:\d+}/{action}/{cid:\d+}');

try {
    $route->dispatch($url);
} catch (NotFoundException) {
    \App\Controllers\Error::missing();
} catch (Exception $e) {
    echo '<pre>';
    var_dump($e->getMessage());
    echo '</pre>';
}
