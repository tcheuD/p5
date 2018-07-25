<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
function dbConnect()
{
    $config = require __DIR__ . './../config/pdo.php';

    try {
        return new PDO('mysql:host=' . $config["host"] . ';dbname=' . $config['dbname'] . ';charset=utf8',
            $config['username'], $config['password']);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getPosts()
{
    return dbConnect()->query(
        'SELECT p.id id, p.user_id user_id, u.nickname user_nickname, p.title title, p.content content, p.modification_date, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') 
                    creation_date_fr
                    FROM posts p
                    INNER JOIN users u
                    ON p.user_id = u.id
                    ORDER BY creation_date_fr
                    ');
}

function getPostsByUserId($userId)
{
    $query = dbConnect()->prepare(
        'SELECT *
                    FROM posts 
                    WHERE user_id = :userId
                    ');
    $query->bindValue(':userId', $userId, PDO::PARAM_STR);
    $query->execute();
    $query->fetch();

    return $query;

}

function getUsers()
{
    return dbConnect()->query(
        'SELECT * FROM users
                ');
}


function getComments($postId)
{
    $query = dbConnect()->prepare(

        'SELECT c.comment AS comment,
                          c.id AS c_comment_id, 
                          u.nickname AS user_nickname,
                          u.id AS u_user_id
                    FROM comments c
                    INNER JOIN users u
                    ON c.user_id = u.id
                    WHERE c.post_id = :id');
    $query->bindValue(':id', $postId, PDO::PARAM_STR);
    $query->execute();
    $query->fetch();

    return $query;

}

function checkEmail($email)
{
    $query = dbConnect()->prepare(
        'SELECT *
                    FROM users
                    WHERE email = :email');
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    return $query->fetch();

}

function checkNickname($nickname)
{
    $query = dbConnect()->prepare(
        'SELECT *
                    FROM users
                    WHERE nickname = :nickname');
    $query->bindValue(':nickname', $nickname, PDO::PARAM_STR);
    $query->execute();
    return $query->fetch();

}

function postComment($postId, $userId, $content)
{
    $query = dbConnect()->prepare("INSERT INTO comments(user_id, post_id, comment_date, comment) VALUES(:user_id, :post_id, NOW(), :content)");
    $query->bindParam(':user_id', $userId);
    $query->bindParam(':post_id', $postId);
    $query->bindParam(':content', $content);
    return $query->execute();
}

function addPost($title, $content, $user_id)
{
    $dbConnect = dbConnect();
    $query = $dbConnect->prepare("INSERT INTO posts(user_id, title, status, creation_date, content) VALUES(:user_id,:title, 1, NOW(), :content)");
    $query->bindParam(':user_id', $user_id);
    $query->bindParam(':title', $title);
    $query->bindParam(':content', $content);
    $query->execute();

    $id = $dbConnect->lastInsertId();
    return $id;
}

function addAccount($users_group, $nickname, $password, $email)
{
    $query = dbConnect()->prepare("INSERT INTO users(users_group, registration_date, nickname, email, password) VALUES(:users_group, NOW(), :nickname, :email, :password)");
    $query->bindParam(':users_group', $users_group);
    $query->bindParam(':nickname', $nickname);
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);

    return $query->execute();
}

function deleteAccount($id)
{
    $query = dbConnect()->prepare("DELETE FROM users WHERE id=:id");
    $query->bindParam(':id', $id);

    return $query->execute();
}


function deletePost($id)
{
    $query = dbConnect()->prepare("DELETE FROM posts WHERE id=:id");
    $query->bindParam(':id', $id);

    return $query->execute();
}

function deleteComment($id)
{
    $query = dbConnect()->prepare("DELETE FROM comments WHERE id=:id");
    $query->bindParam(':id', $id);

    return $query->execute();
}

function editPost($title, $content, $id)
{
    $query = dbConnect()->prepare("UPDATE posts 
                                  SET title =:title, content =:content, modification_date = NOW() 
                                  WHERE id =:id"
    );
    $query->bindParam(':title', $title);
    $query->bindParam(':content', $content);
    $query->bindParam(':id', $id);

    return $query->execute();
}

function editComment($content, $id)
{
    $query = dbConnect()->prepare("UPDATE comments 
                                  SET comment =:content, modification_date = NOW() 
                                  WHERE id =:id"
    );
    $query->bindParam(':content', $content);
    $query->bindParam(':id', $id);

    return $query->execute();
}


function editAccount($usersGroup, $nickname, $email, $password, $id)
{
    $query = dbConnect()->prepare("UPDATE users 
                                  SET users_group =:users_group, nickname =:nickname, email =:email , password =:password  
                                  WHERE id =:id"
    );
    $query->bindParam(':users_group', $usersGroup);
    $query->bindParam(':nickname', $nickname);
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);
    $query->bindParam(':id', $id);

    return $query->execute();
}

function getPost($postId)
{
    $query = dbConnect()->prepare(

        'SELECT p.user_id user_id, u.nickname user_nickname, p.title title, p.content content, 
                      p.modification_date, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\')
                      creation_date_fr
                    FROM posts p
                    INNER JOIN users u
                    ON p.user_id = u.id
                    WHERE p.id = :id
                    ');
    $query->bindValue(':id', $postId, PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();
}

function getUser($id)
{
    $query = dbConnect()->prepare(
        "SELECT * FROM users WHERE id = :id");
    $query->bindValue(':id', $id, PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();
}

function getUserByNickname($nickname)
{
    $query = dbConnect()->prepare(
        "SELECT * FROM users WHERE nickname = :nickname");
    $query->bindValue(':nickname', $nickname, PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();
}

function getComment($id)
{
    $query = dbConnect()->prepare(
        "SELECT * FROM comments WHERE id = :id");
    $query->bindValue(':id', $id, PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();
}

function updateUser($pseudo)
{
    $query = dbConnect()->prepare("UPDATE users 
                                  SET last_connection = NOW() 
                                  WHERE nickname = :pseudo"
    );
    $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);

    return $query->execute();
}

function getTryAttempt($ip)
{
    $query = dbConnect()->prepare(
        "SELECT * FROM loginAttempt WHERE ip = :ip");
    $query->bindValue(':ip', $ip, PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();

}