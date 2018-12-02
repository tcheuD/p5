<?php

namespace App;

use Core\Interfaces\RequestInterface;
use Core\Interfaces\ResponseInterface;
use Core\Router;

class Kernel
{
    private $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        return $this->router->handleRequest($request);
    }

}
