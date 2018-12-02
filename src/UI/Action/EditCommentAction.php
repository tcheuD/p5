<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\EditCommentActionInterface;
use App\Domain\Repository\CommentRepository;
use App\Domain\Repository\AccountRepository;
use App\Domain\Factory\CommentFactory;
use Core\Response;
use Core\Twig;


class EditCommentAction implements EditCommentActionInterface
{

    private $accountRepository;
    private $commentRepository;
    private $session;
    private $twig;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
        $this->commentRepository = new CommentRepository();
        $this->twig = new Twig();
    }

    public function __invoke($request, $id)
    {
        $this->session = $request->getSession();
        $comment = $this->commentRepository->getComment($id);
        $postId = $comment->getPostId();

        if ($this->session->get('id')) {

            if ($id == intval($this->session->get('id')) || $this->session->isAdmin()) {

                    $showForm = true;

                    if (isset($_POST["comment"])) {

                        $prepare = CommentFactory::edit($comment, $_POST);
                        $status = $this->commentRepository->editComment($prepare);
                        header("Location: /p5/blog/post/$postId");
                        exit;
                    }


                } else $showForm = false;
            }
        return new Response($this->twig->getTwig($request)->render('editComment.html.twig',
            array('showForm' => $showForm, 'comment' => $comment)));
        }
}
