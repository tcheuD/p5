<?php

namespace App\UI\Action;

use App\Domain\Repository\CommentRepository;
use App\UI\Action\Interfaces\DeleteCommentActionInterface;
use Core\Interfaces\RequestInterface;
use Core\Response;
use Core\Token;
use Core\Twig;

class DeleteCommentAction implements DeleteCommentActionInterface
{
    private $commentRepository;
    private $session;
    private $twig;
    private $userId;
    private $token;


    public function __construct()
    {
        $this->commentRepository = new CommentRepository();
        $this->twig = new Twig();
        $this->token= new Token();

    }

    public function __invoke(RequestInterface $request, $id)
    {

        $this->session = $request->getSession();
        $comment = $this->commentRepository->getComment($id);
        $this->userId = $comment->getUser();
        $showForm = false;

        if ($this->session->get('id')) {
            if ($this->userId = $this->session->get('id') || $this->session->isAdmin()) {
                if ($this->token->checkValidity($this->session->get('token'), $_POST["token"])) {
                    $status = $this->commentRepository->deleteComment($id);
                    $postId = $comment->getPostId();
                    $showForm = true;
                    header("Location: /p5/blog/post/$postId");
                    exit;
                }
            }
        }

        return new Response($this->twig->getTwig($request)->render('deleteComment.html.twig', array('showForm' => $showForm)));
    }
}
