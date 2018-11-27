<?php

namespace Core;

use App\UI\Action\NotFoundAction;
use Core\Interfaces\RequestInterface;

class Router
{

    private $routes = [];
    private $actionResolver;

    public function __construct()
    {
        $this->constructRoute();
        $this->actionResolver = new ActionResolver();
    }

    public function constructRoute()
    {
        $routes = require_once __DIR__.'./../config/routes.php';
        foreach ($routes as $key => $value) {
            $route [] = new Route(
                $value['path'],
                $value['action'],
                $value['params'] ?? [],
                $_SERVER['REQUEST_URI'],
                $value["methods"]
            );
        }
        $this->routes= $route;
    }


    public function handleRequest(RequestInterface $request)
    {

        foreach ($this->routes as $route) {
            switch ($request->getRequestUri()) {
                case $route->getPath() === $request->getRequestUri() && \in_array($request->getMethod(), $route->getMethods()):
                    return $this->actionResolver->resolveAction($route->getParam(), $route->getAction(), $request);
                    break;
            }
        }

        return $this->actionResolver->resolveAction([], NotFoundAction::class, $request);


    }
}