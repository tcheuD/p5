<?php

namespace App\UI\Action\Interfaces;

use Core\Interfaces\RequestInterface;

interface ForgotPasswordActionInterface
{
    public function __construct();
    public function __invoke(RequestInterface $request);

}