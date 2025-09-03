<?php

require_once '../vendor/autoload.php';

use App\Controllers\Home;
use App\Core\Router;

echo '<h1>Redirected to PUBLIC folder</h1>';

echo '<pre>';
var_dump(__DIR__);
echo '</pre>';

$home = new Home();
echo $home->index();

// echo '<pre>';
// var_dump($_SERVER);
// echo '</pre>';

// Routing
$url = ltrim($_SERVER['REQUEST_URI'], '\/');


$route = new Router();
$route->add('', ['controller' => 'home', 'action' => 'index']);
$route->add('{controller}/{action}');
$route->add('{controller}/{id:\d+}/{action}');
$route->add('{controller}/{id:\d+}/{action}/{cid:\d+}');

echo '<pre>';
var_dump($route->getRoutes());
echo '</pre>';

$route->dispatch($url);