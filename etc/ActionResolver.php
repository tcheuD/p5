<?php

namespace Core;

class ActionResolver
{
    public function resolveAction(string $action, array $params = [])
    {
        $class = new $action();
        return $class($params);
    }
}
