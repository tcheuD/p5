<?php
/**
 * Created by PhpStorm.
 * User: agathe
 * Date: 13/09/2018
 * Time: 10:23
 */

namespace Core\Interfaces;


interface RequestInterface
{

    public function getRequestUri();

    public function getMethod();

}