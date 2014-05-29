<?php

require_once 'Banshee/Route.php';

$route = new \Banshee\Route;

$route->get('/', function () {
    echo "Hello, World!";
});

try {
    $route->start();
} catch (\Banshee\BansheeRouteException $e) {
    die($e->getMessage());
}
