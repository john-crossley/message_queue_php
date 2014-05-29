<?php

// TODO - Move this shit to an autoloader.
require_once 'src/Banshee/Exceptions/BansheeRouteException.php';
require_once 'src/Banshee/Route.php';

$route = new \Banshee\Route;

$route->get('/', function () {
    echo "Hello, World!";
});

try {
    $route->run();
} catch (\Banshee\BansheeRouteException $e) {
    die($e->getMessage());
}
