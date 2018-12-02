<?php

namespace App\UI\Action;

use App\Domain\Repository\PostRepository;
use Core\Interfaces\RequestInterface;
use Core\Response;
use Core\Twig;

class MyPosts
{

    private $postRepository;
    private $session;
    private $twig;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
        $this->twig = new Twig();
    }

    public function __invoke(RequestInterface $request)
    {
        $this->session = $request->getSession();
        $posts = $this->postRepository->getPostsByUserId($this->session->get('id'));

        return new Response($this->twig->getTwig($request)->render('myPosts.html.twig', array('posts' => $posts)));
    }
}
