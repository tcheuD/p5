<?php

namespace Core;


use Core\Interfaces\RequestInterface;

class AppVariable
{
    private $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }


    public function getRequest()
    {
        return $this->request;
    }
}
