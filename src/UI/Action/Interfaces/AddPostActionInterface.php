<?php

namespace App\UI\Action\Interfaces;

use Core\Interfaces\RequestInterface;

interface AddPostActionInterface
{
    public function __invoke(RequestInterface $request);
}