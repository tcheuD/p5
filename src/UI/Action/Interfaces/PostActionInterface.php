<?php

namespace App\UI\Action\Interfaces;
use Core\Interfaces\RequestInterface;

interface PostActionInterface
{
    public function __invoke(RequestInterface $request, $id);
}