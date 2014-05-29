<?php

namespace Banshee;

class Route {

    public $routes = array();

    public function get($route, Callable $callable) {
        $this->routes[$route] = $callable;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function run($path = null)
    {
        if (!$path) {
            $path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
        }

        if (!isset($this->routes[$path])) {
            throw new BansheeRouteException("Unable to locate route..");
        }

        return $this->routes[$path]();
    }

}
