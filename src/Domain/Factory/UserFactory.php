<?php

namespace App\Domain\Factory;
use App\Domain\Model\User;

class UserFactory
{
    public static function buildRegistration($data, $pass)
    {
        $user = new User();
        $user->setUsersGroup(1);
        $user->setNickname($data["nickname"]);
        $user->setPassword($pass);
        $user->setEmail($data["email"]);
        return $user;
    }

    public static function buildAccount($data, $pass)
    {
        $user = new User();
        $user->setUsersGroup($data["users_group"]);
        $user->setNickname($data["nickname"]);
        $user->setPassword($pass);
        $user->setEmail($data["email"]);
        return $user;
    }

    public static function buildEdit($user, $data, $pass)
    {
        $user->setUsersGroup($data["users_group"]);
        $user->setNickname($data['nickname']);
        $user->setEmail($data['email']);
        $user->setPassword($pass);
        return $user;
    }

    public static function buildSetPassIdentity($user, $pass)
    {
        $user->setForgotPassIdentity($pass);
        return $user;
    }

    public static function buildResetPassword($user, $password)
    {
        $user->setPassword($password);
        return $user;
    }



}