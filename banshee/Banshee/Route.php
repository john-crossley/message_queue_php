<?php

namespace Banshee;

class BansheeRouteException extends \Exception {}

class Route {

    public $routes = array();

    public function get($route, Callable $callable) {
        $this->routes[$route] = $callable;
    }

    public function start()
    {
        $path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';

        if (!isset($this->routes[$path])) {
            throw new BansheeRouteException("Unable to locate route..");
        }

        $this->routes[$path]();
    }

}
