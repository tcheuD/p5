<?php
/**
 * Created by PhpStorm.
 * User: agathe
 * Date: 16/08/2018
 * Time: 15:56
 */

namespace App\UI\Action\Interfaces;


interface DeleteAccountActionInterface
{
    public function __invoke($request, $id);
}