<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\AddPostActionInterface;
use App\Domain\Repository\PostRepository;
use App\Domain\Factory\PostFactory;
use Core\Interfaces\RequestInterface;
use Core\Response;
use Core\Token;
use Core\Twig;


class AddPostAction implements AddPostActionInterface
{
    private $postRepository;
    private $session;
    private $twig;
    private $token;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
        $this->twig = new Twig();
        $this->token = new Token();
    }

    public function __invoke(RequestInterface $request)
    {

        $this->session = $request->getSession();

        if ($this->session->get('id')) {

            if (isset($_POST["title"], $_POST["content"], $_POST["token"])) {

                if ($this->token->checkValidity($this->session->get('token'), $_POST["token"])) {

                    $post = PostFactory::add($_POST);
                    $status = $this->postRepository->addPost($post);
                    header("Location: post/$status");
                    exit();
                }
            }
        }
            return new Response($this->twig->getTwig($request)->render('addPost.html.twig'));
        }
}
