<?php

namespace App\UI\Action;


use Core\Response;

class NotFoundAction
{
    public function __invoke($request)
    {
        return new Response("hello world");
    }
}