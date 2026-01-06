<?php

require_once '../vendor/autoload.php';

use App\Core\App;

$app = new App(dirname(__DIR__));

// Routing
$app->router->add('', ['controller' => 'categories', 'action' => 'index', 'id' => 1]);
$app->router->add('{controller}/{action}');
$app->router->add('{controller}/{id:\d+}/{action}');
$app->router->add('{controller}/{id:\d+}/{action}/{cid:\d+}');
$app->router->add('admin/{controller}/{action}', ['namespace' => 'admin']);
$app->router->add('admin/{controller}/{id:\d+}/{action}', ['namespace' => 'admin']);

$app->run();
