<?php

function checkSignUpDataValidity($nickname, $email)
{
    $mail = checkEmail($email);
    $alias = checkNickname($nickname);

    if ($alias && $mail) {
        $return = 3;
    } elseif ($mail) {
        $return = 1;
    } elseif ($alias) {
        $return = 2;
    } else $return = 0;

    return $return;
}
