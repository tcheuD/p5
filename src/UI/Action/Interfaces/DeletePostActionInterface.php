<?php

namespace App\UI\Action\Interfaces;


interface DeletePostActionInterface
{
    public function __invoke($request, $id);
}