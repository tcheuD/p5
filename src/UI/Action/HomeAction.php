<?php

namespace App\UI\Action;
use App\Domain\Repository\PostRepository;
use App\Domain\Model\Post;
use App\Domain\Model\User;
require_once __DIR__.'./../../../etc/viewLoader.php';


class HomeAction
{

    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    public function __invoke()
    {
        $posts = $this->postRepository->getPosts();
        require loadView('index.php');

    }
}