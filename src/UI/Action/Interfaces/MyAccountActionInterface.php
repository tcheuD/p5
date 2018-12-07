<?php

namespace App\UI\Action\Interfaces;

use Core\Interfaces\RequestInterface;

interface MyAccountActionInterface
{
    public function __construct();
    public function __invoke(RequestInterface $request);
    public function countPostsAndComs($datas);
}