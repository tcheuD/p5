<?php

namespace App\Domain\Repository;
use App\Domain\Model\Comment;
use App\Domain\Model\Post;
use App\Domain\Model\User;
use Core\Database as Database;

final class CommentRepository
{
    public function getComments($postId)
    {

        $query = Database::dbConnect()->prepare(
            'SELECT comments.id,
                              comments.user_id user,
                              comments.post_id,
                              comments.comment_date,
                              comments.comment,
                              comments.modification_date
                    FROM comments
                    INNER JOIN users 
                    on comments.user_id = users.id
                    WHERE comments.post_id = :id
                    ');
        $query->bindValue(':id', $postId, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, Comment::class);
        $comments = $query->fetchAll();

        $query = Database::dbConnect()->prepare(
            'SELECT users.id id,
                              users.nickname
                    FROM users
                    INNER JOIN comments 
                    on comments.user_id = users.id
                    WHERE comments.post_id = :id
                    ');
        $query->bindValue(':id', $postId, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $users = $query->fetchAll();

        foreach ($comments as $key=>$value)
        {
            $comments[$key]->setUser($users[$key]);
        }

        return $comments;

    }

    public function postComment(Comment $comment)
    {
        $query = Database::dbConnect()->prepare("INSERT INTO comments(user_id, post_id, comment_date, comment) 
                                                  VALUES(:user_id, :post_id, NOW(), :content)");
        $query->bindValue(':user_id', $comment->getUser());
        $query->bindValue(':post_id', $comment->getPostId());
        $query->bindValue(':content', $comment->getComment());
        return $query->execute();
    }

    public function deleteComment($id)
    {
        $query = Database::dbConnect()->prepare("DELETE FROM comments WHERE id=:id");
        $query->bindParam(':id', $id);

        return $query->execute();
    }

    public function deleteAllFromUser($userId)
    {
        $query = Database::dbConnect()->prepare("DELETE FROM comments WHERE user_id=:userId");
        $query->bindParam(':userId', $userId);

        return $query->execute();
    }

    public function deleteAllFromPost($postId)
    {
        $query = Database::dbConnect()->prepare("DELETE FROM comments WHERE post_id=:postId");
        $query->bindParam(':postId', $postId);

        return $query->execute();
    }

    public function editComment(Comment $comment)
    {
        $query = Database::dbConnect()->prepare("UPDATE comments 
                                  SET comment =:content, modification_date = NOW() 
                                  WHERE id =:id"
        );
        $query->bindValue(':content', $comment->getComment());
        $query->bindValue(':id', $comment->getId());

        return $query->execute();
    }

    public function getComment($id)
    {
        $query = Database::dbConnect()->prepare(
            "SELECT id, user_id user, post_id postId, comment_date, comment, modification_date FROM comments WHERE id = :id");
        $query->bindValue(':id', $id, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, Comment::class);
        return $query->fetch();
    }

    public function getCommentsByUserId($userId)
    {
        $query = Database::dbConnect()->prepare(
            'SELECT comments.id,
                              comments.user_id user,
                              comments.post_id postId,
                              comments.comment_date,
                              comments.comment,
                              comments.modification_date
                    FROM comments 
                    INNER JOIN posts
                    on comments.post_id = posts.id
                    WHERE comments.user_id = :userId
                    ');
        $query->bindParam(':userId', $userId);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, Comment::class);
        $comments = $query->fetchAll();

        $query = Database::dbConnect()->prepare(
            'SELECT posts.id,
                              posts.title,
                              posts.content
                    FROM posts
                    INNER JOIN comments 
                    on comments.post_id = posts.id
                    WHERE comments.user_id = :userId
                    ');
        $query->bindValue(':userId', $userId, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, Post::class);
        $posts = $query->fetchAll();

        foreach ($comments as $key=>$value)
        {
            $comments[$key]->setPostId($posts[$key]);
        }

        return $comments;

    }

}