<?php
/**
 * Created by PhpStorm.
 * User: agathe
 * Date: 27/08/2018
 * Time: 11:57
 */

namespace App\UI\Action\Interfaces;
use Core\Interfaces\RequestInterface;

interface PostActionInterface
{
    public function __invoke(RequestInterface $request, $id);
}