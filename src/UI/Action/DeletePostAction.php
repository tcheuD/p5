<?php

namespace App\UI\Action;

use App\Domain\Repository\CommentRepository;
use App\Domain\Repository\PostRepository;
use App\UI\Action\Interfaces\DeletePostActionInterface;
use Core\Response;
use Core\Twig;

class DeletePostAction implements DeletePostActionInterface
{
    private $postRepository;
    private $commentRepository;
    private $session;
    private $twig;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
        $this->commentRepository = new CommentRepository();
        $this->twig = new Twig();
    }


    public function __invoke($request, $id) {


        $this->session = $request->getSession();
        $post = $this->postRepository->getPost($id);
        $showForm = false;

        if ($this->session->get('id')) {

            if ($post->getUser()->getId() == intval($this->session->get('id')) || $this->session->isAdmin()) {
                    $showForm = true;
                    $status = $this->postRepository->deletePost($id);
                    $this->commentRepository->deleteAllFromPost($id);
                    header("Location: /p5/");
                }
            }

        return new Response($this->twig->getTwig($request)->render('deletePost.html.twig', ['showForm' => $showForm]));
    }
}


