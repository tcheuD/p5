<?php

namespace Core;
use Core\Interfaces\RequestInterface;

class ActionResolver
{
    public function resolveAction($params, $action, RequestInterface $request)
    {
        $class = new $action;

        if ($params !== null) {
            return $class($request, $params);
        } else {
            return $class($request);
        }
    }
}
