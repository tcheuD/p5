<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\AddPostActionInterface;
use App\Domain\Repository\PostRepository;
use App\Domain\Factory\PostFactory;
use Core\Interfaces\RequestInterface;
use Core\Response;
use Core\Twig;


class AddPostAction implements AddPostActionInterface
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

        if ($this->session->parameterExist('id')) {

            if (isset($_POST["title"]) && isset($_POST["content"])) {

                $post = PostFactory::add($_POST);
                $status = $this->postRepository->addPost($post);
                header("Location: post/$status");
                exit;
            }
        }
            return new Response($this->twig->getTwig($request)->render('addPost.html.twig'));
        }
}
