<?php

namespace App\Domain\Factory;
use App\Domain\Model\Comment;

class CommentFactory
{
    public static function add($data, $postId)
    {
        $comment = new Comment();

        $comment->setPostId($postId);
        $comment->setUser(intval($_SESSION['id']));
        $comment->setComment($data["comment"]);
        return $comment;
    }

    public static function edit($comment, $data)
    {
        $comment->setUser(intval($_SESSION["id"]));
        $comment->setComment($data["comment"]);
        return $comment;
    }

}