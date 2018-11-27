<?php
/**
 * Created by PhpStorm.
 * User: agathe
 * Date: 16/08/2018
 * Time: 16:16
 */

namespace App\UI\Action\Interfaces;


interface EditPostActionInterface
{
    public function __invoke($request, $id);
}