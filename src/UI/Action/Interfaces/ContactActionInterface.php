<?php

namespace App\UI\Action\Interfaces;

use Core\Interfaces\RequestInterface;

interface ContactActionInterface
{
    public function __construct();
    public function __invoke(RequestInterface $request);
}