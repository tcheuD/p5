<?php

namespace Core;

class Router
{

    private $routes = [];

    public function __construct()
    {
        $this->constructRoute();
    }

    public function constructRoute()
    {
        $routes = require_once __DIR__.'./../config/routes.php';
        foreach ($routes as $key => $value) {
            $route [] = new Route(
                $value['path'],
                $value['action']
            );
        }
        $this->routes= $route;
    }

    public function catchParams(Route $route, $uri)
    {
        $route->match($uri);
    }

    public function handleRequest()
    {
        foreach ($this->routes as $route) {
            $this->catchParams($route, $_SERVER['REQUEST_URI']);
            switch ($_SERVER['REQUEST_URI']) {
                case $route->getPath():
                    $actionResolver = new ActionResolver();
                    $actionResolver->resolveAction($route->getAction(), $route->getParam());
                    break;
            }
        }
    }

}