<?php

namespace App\Domain\Model;

class Post
{
    private $id;
    private $user;
    private $title;
    private $status;
    private $creationDate;
    private $content;
    private $modificationDate;


    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setTitle($title)
    {
        $this->title = htmlspecialchars($title);
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setCreationDate($creation_date)
    {
        $this->creationDate = $creation_date;
    }

    public function setContent($content)
    {
        $this->content = htmlspecialchars($content);
    }

    public function setModificationDate($modification_date)
    {
        $this->modificationDate = $modification_date;
    }
}
