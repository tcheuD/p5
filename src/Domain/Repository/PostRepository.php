<?php

namespace App\Domain\Repository;
use App\Domain\Model\User;
use App\Domain\Model\Post;
use Core\Database as Database;

final class PostRepository
{

    public function addPost(Post $post)
    {
        $dbConnect = Database::dbConnect();
        $query = $dbConnect->prepare("INSERT INTO posts(user_id, title, status, creation_date, content) 
                                                VALUES(:user_id,:title, 1, NOW(), :content)");
        $query->bindParam(':user_id', $post->getUser());
        $query->bindParam(':title', $post->getTitle());
        $query->bindParam(':content', $post->getContent());
        $query->execute();

        $id = $dbConnect->lastInsertId();
        return $id;
    }

    public function getPosts()
    {
        $query = Database::dbConnect()->prepare(
            'SELECT posts.id,
                             posts.user_id user,
                             posts.title,
                             posts.content,
                             posts.creation_date creationDate,
                             posts.modification_date modificationDate
                      FROM posts 
                      INNER JOIN users 
                      on posts.user_id = users.id
                      ORDER BY posts.creation_date DESC
         ');
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, Post::class);
        $posts = $query->fetchAll();

        $query = Database::dbConnect()->prepare(
            'SELECT users.id,
                              users.nickname
                        FROM users 
                        INNER JOIN posts
                        on posts.user_id = users.id
             ');
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $users = $query->fetchAll();

        foreach ($posts as $key=>$value)
        {
            $posts[$key]->setUser($users[$key]);
        }

        return $posts;
    }

    public function getPost($postId)
    {
        $query = Database::dbConnect()->prepare(
            'SELECT posts.id,
                             posts.user_id user,
                             posts.title,
                             posts.content,
                             posts.creation_date creationDate,
                             posts.modification_date modificationDate
                      FROM posts 
                      INNER JOIN users 
                      on posts.user_id = users.id
                      WHERE posts.id = :id          
         ');
        $query->bindParam(':id', $postId);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, Post::class);
        $post = $query->fetch();

        $query = Database::dbConnect()->prepare(
            'SELECT users.id id,
                              users.nickname
                        FROM users 
                        INNER JOIN posts
                        on posts.user_id = users.id
                        WHERE posts.id = :id
             ');
        $query->bindParam(':id', $postId);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $user = $query->fetch();

            $post->setUser($user);

        return $post;
    }

    public function deletePost($id)
    {
        $query = Database::dbConnect()->prepare("DELETE FROM posts WHERE id=:id");
        $query->bindParam(':id', $id);

        return $query->execute();
    }

    public function deleteAllFromUser($userId)
    {
        $query = Database::dbConnect()->prepare("DELETE FROM posts WHERE user_id=:userId");
        $query->bindParam(':userId', $userId);

        return $query->execute();
    }


    public function editPost(Post $post, $id)
    {
        $query = Database::dbConnect()->prepare("UPDATE posts 
                                  SET title =:title, 
                                      content =:content, 
                                      modification_date = NOW() 
                                  WHERE id =:id"
        );
        $query->bindValue(':title', $post->getTitle());
        $query->bindValue(':content', $post->getContent());
        $query->bindValue(':id', $id);

        return $query->execute();
    }

    public function getPostsByUserId($userId)
    {
        $query = Database::dbConnect()->prepare(
            'SELECT id,
                              user_id user,
                              title,
                              status,
                              creation_date,
                              content,
                              modification_date
                    FROM posts 
                    WHERE user_id = :userId
                    ');
        $query->bindParam(':userId', $userId);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, Post::class);

        return $query->fetchAll();

    }

}
