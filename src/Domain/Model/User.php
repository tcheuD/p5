<?php

namespace App\Domain\Model;

class User
{
    const USER = 1;
    const ADMIN = 2;

    private $id;
    private $users_group;
    private $registrationDate;
    private $lastConnection;
    private $nickname;
    private $email;
    private $password;
    private $forgot_pass_identity;

    public function getId()
    {
        return $this->id;
    }

    public function getUsersGroup()
    {
        return $this->users_group;
    }

    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    public function getLastConnection()
    {
        return $this->lastConnection;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getForgotPassIdentity()
    {
        return $this->forgot_pass_identity;
    }

    public function setId($id)
    {
        $id = (int) $id;

        if ($id > 0)
        {
            $this->id = $id;
        }
    }

    public function setUsersGroup($users_group)
    {
        //TODO replace users groups by CONST instead of number
        $this->users_group = intval($users_group);
    }

    public function setRegistrationDate($registration_date)
    {
        $this->registrationDate = $registration_date;
    }

    public function setLastConnection($last_connection)
    {
        $this->lastConnection = $last_connection;
    }

    public function setNickname($nickname)
    {
        if (is_string($nickname))
        {
            $this->nickname = $nickname;
        }
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setForgotPassIdentity($forgotPassIdentity)
    {
        $this->forgot_pass_identity = $forgotPassIdentity;
    }
}