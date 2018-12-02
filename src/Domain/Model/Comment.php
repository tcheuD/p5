<?php

namespace App\Domain\Model;

class Comment
{
    private $id;
    private $user;
    private $postId;
    private $commentDate;
    private $comment;
    private $modificationDate;

    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function getCommentDate()
    {
        return $this->commentDate;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = intval($id);
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    public function setCommentDate($commentDate)
    {
        $this->commentDate = $commentDate;
    }

    public function setComment($comment)
    {
        $this->comment = htmlspecialchars($comment);
    }

    public function setModificationDate($modificationDate)
    {
        $this->modificationDate = $modificationDate;
    }
}
