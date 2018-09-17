<?php

namespace App;

use Core\Interfaces\RequestInterface;
use Core\Router;

class Kernel
{
    private $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function handle(RequestInterface $request)
    {
        $this->router->handleRequest($request);
    }
}