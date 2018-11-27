<?php
/**
 * Created by PhpStorm.
 * User: agathe
 * Date: 16/08/2018
 * Time: 16:00
 */

namespace App\UI\Action\Interfaces;


use Core\Interfaces\RequestInterface;

interface DeleteCommentActionInterface
{
    public function __invoke(RequestInterface $request, $id);
}