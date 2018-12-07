<?php

namespace App\UI\Action;

use App\Domain\Repository\PostRepository;
use App\UI\Action\Interfaces\ListPostsActionInterface;
use Core\Interfaces\RequestInterface;
use Core\Response;
use Core\Twig;

class ListPostsAction implements ListPostsActionInterface
{

    private $postRepository;
    private $twig;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
        $this->twig = new Twig();
    }

    public function __invoke(RequestInterface $request)
    {
        $posts = $this->postRepository->getPosts();

        return new Response($this->twig->getTwig($request)->render('listPosts.html.twig', array('posts' => $posts)));
    }
}
