<?php

namespace Core;


class ParameterBag
{
    private $parameter = [];

    public function __construct($parameter)
    {
        $this->parameter = $parameter;
    }

    public function get($key, $default = null)
    {
        return array_key_exists($key, $this->parameter) ? $this->parameter[$key] : $default;
    }

}