<?php

namespace App\Domain\Repository;
use App\Domain\Model\User;
use Core\Database as Database;


final class AccountRepository
{

    public function getUsers()
    {
        return Database::dbConnect()->query(
            'SELECT * FROM users
                ');
    }

    public function checkEmail($email)
    {
        $query = Database::dbConnect()->prepare(
            'SELECT *
                    FROM users
                    WHERE email = :email');
        $query->bindValue(':email', $email, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);


        return $query->fetch();
    }

    public function checkNickname($nickname)
    {
        $query = Database::dbConnect()->prepare(
            'SELECT *
                    FROM users
                    WHERE nickname = :nickname');
        $query->bindValue(':nickname', $nickname, \PDO::PARAM_STR);
        $query->execute();

        return $query->fetch();
    }

    public function addAccount(User $user)
    {
        $dbConnect = Database::dbConnect();
        $query = $dbConnect->prepare("INSERT INTO users(
                                                           users_group, 
                                                           registration_date, 
                                                           nickname, 
                                                           email, 
                                                           password) 
                                               VALUES(:users_group, NOW(), :nickname, :email, :password )");
        $query->bindValue(':users_group', $user->getUsersGroup());
        $query->bindValue(':nickname', $user->getNickname());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':password', $user->getPassword());

        return $query->execute();
    }

    public function deleteAccount(User $user)
    {
        $query = Database::dbConnect()->prepare("DELETE FROM users WHERE id=:id");
        $query->bindValue(':id', $user->getId());

        return $query->execute();
    }


    public function editAccount(User $user)
    {
        $query = Database::dbConnect()->prepare("
                                  UPDATE users 
                                  SET users_group =:users_group,
                                      nickname =:nickname, 
                                      email =:email, 
                                      password =:password  
                                  WHERE id =:id"
        );
        $query->bindValue(':users_group', $user->getUsersGroup());
        $query->bindValue(':nickname', $user->getNickname());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':password', $user->getPassword());
        $query->bindValue(':id', $user->getId());

        return $query->execute();
    }

    public function getUser($id)
    {
        $query = Database::dbConnect()->prepare(
            "SELECT * FROM users WHERE id = :id");
        $query->bindValue(':id', $id, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);

        return $query->fetch();
    }

    public function getUserByNickname($nickname)
    {
        $query = Database::dbConnect()->prepare(
            "SELECT * FROM users WHERE nickname = :nickname");
        $query->bindValue(':nickname', $nickname, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);

        return $query->fetch();
    }

    public function getUserPassIdentity($pass)
    {
        $query = Database::dbConnect()->prepare(
            "SELECT * FROM users WHERE forgot_pass_identity = :pass");
        $query->bindValue(':pass', $pass, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);

        return $query->fetch();
    }

    public function updateUser(User $user)
    {
        $query = Database::dbConnect()->prepare("
                                  UPDATE users 
                                  SET last_connection = NOW() 
                                  WHERE id = :id"
        );
        $query->bindValue(':id', $user->getId(), \PDO::PARAM_STR);

        return $query->execute();
    }

    public function setUserPassIdentity(User $user)
    {
        $query = Database::dbConnect()->prepare("
                                  UPDATE users 
                                  SET forgot_pass_identity = :forgotPassIdentity
                                  WHERE id = :id"
        );
        $query->bindValue(':forgotPassIdentity', $user->getForgotPassIdentity());
        $query->bindValue(':id', $user->getId());
        return $query->execute();
    }

}
