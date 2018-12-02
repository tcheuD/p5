<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\EditPostActionInterface;
use App\Domain\Repository\PostRepository;
use App\Domain\Repository\AccountRepository;
use App\Domain\Factory\PostFactory;
use Core\Response;
use Core\Twig;

class EditPostAction implements EditPostActionInterface
{
    private $postRepository;
    private $accountRepository;
    private $session;
    private $twig;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
        $this->accountRepository = new AccountRepository();
        $this->twig = new Twig();
    }

    public function __invoke($request, $id)
    {
        $post = $this->postRepository->getPost($id);
        $this->session = $request->getSession();

        if ($this->session->get('id')) {

            if ($id == intval($this->session->get('id')) || $this->session->isAdmin()) {

                $showForm = true;

                if (isset($_POST["title"], $_POST["content"])) {

                    $prepare = PostFactory::edit($post, $_POST);
                    $status = $this->postRepository->editPost($prepare, $id);
                    header("Location: /blog/post/$id");
                    exit;
                }
            } else $showForm = false;
        }
        return new Response($this->twig->getTwig($request)->render('editPost.html.twig',
            array('showForm' => $showForm, 'post' => $post)));

    }

    }
