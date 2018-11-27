<?php
/**
 * Created by PhpStorm.
 * User: agathe
 * Date: 16/08/2018
 * Time: 16:03
 */

namespace App\UI\Action\Interfaces;


interface EditAccountActionInterface
{
    public function __invoke($request, $id);
}