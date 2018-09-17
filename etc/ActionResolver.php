<?php

namespace Core;

class ActionResolver
{
    public function resolveAction($action, $params = [])
    {
        $class = new $action;
        return $class($params);
    }
}
