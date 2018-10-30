<?php

namespace App\UI\Action;

use App\Domain\Repository\CommentRepository;
use App\UI\Action\Interfaces\DeleteCommentActionInterface;
use Core\Interfaces\RequestInterface;
use Core\Response;
use Core\Twig;

class DeleteCommentAction implements DeleteCommentActionInterface
{
    private $commentRepository;
    private $session;
    private $twig;
    private $userId;

    public function __construct()
    {
        $this->commentRepository = new CommentRepository();
        $this->twig = new Twig();
    }

    public function __invoke(RequestInterface $request, $id)
    {

        $this->session = $request->getSession();
        $comment = $this->commentRepository->getComment($id);
        $this->userId = $comment->getUser();

        if ($this->session->get('id')) {
            if ($this->userId = $this->session->get('id') || $this->session->isAdmin()) {
                $status = $this->commentRepository->deleteComment($id);
                $postId = $comment->getPostId();
                header("Location: /p5/post/$postId");
            }
        }

        return new Response($this->twig->getTwig($request)->render('deleteComment.html.twig', array('showForm' => $showForm)));
    }
}
