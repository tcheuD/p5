<?php

namespace App\UI\Action;

use App\Domain\Repository\PostRepository;
use App\UI\Action\Interfaces\HomeActionInterface;
use Core\Interfaces\RequestInterface;
use Core\Response;
use Core\Twig;

class HomeAction implements HomeActionInterface
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
        return new Response($this->twig->getTwig($request)->render('index.html.twig'));
    }
}
