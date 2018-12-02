<?php

namespace Core;


class Token
{
    public static function checkValidity($sessionToken, $formToken)
    {
        if ($sessionToken == $formToken) {
            return true;
        } else {
            return false;
        }
    }
}
