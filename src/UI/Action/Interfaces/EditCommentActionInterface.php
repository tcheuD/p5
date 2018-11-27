<?php
/**
 * Created by PhpStorm.
 * User: agathe
 * Date: 16/08/2018
 * Time: 10:22
 */

namespace App\UI\Action\Interfaces;

interface EditCommentActionInterface
{
    public function __invoke($request, $id);

}