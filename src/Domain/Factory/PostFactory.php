<?php

namespace App\Domain\Factory;
use App\Domain\Model\Post;

class PostFactory
{
    public static function add($data)
    {
        $post = new Post();
        $post->setUser($_SESSION["id"]);
        $post->setTitle($data["title"]);
        $post->setContent($data["content"]);
        return $post;
    }

    public static function edit($post, $data)
    {
        $post->setTitle($data['title']);
        $post->setContent($data['content']);
        return $post;
    }

}
