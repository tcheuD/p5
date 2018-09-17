<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\EditCommentActionInterface;
use App\Domain\Repository\CommentRepository;
use App\Domain\Repository\AccountRepository;
use App\Domain\Model\Comment;
use App\Domain\Factory\CommentFactory;

require_once __DIR__.'./../../../etc/viewLoader.php';
require_once __DIR__.'/Interfaces/EditCommentActionInterface.php';

class EditCommentAction implements EditCommentActionInterface
{

    private $accountRepository;
    private $commentRepository;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
        $this->commentRepository = new CommentRepository();
    }

    public function __invoke($params, array $request = [])
    {
        $id = intval($params);
        $comment = $this->commentRepository->getComment($id);
        $postId = $comment->getPostId();
        if (isset($_SESSION['id'])) {
            if ($_SESSION['id'] == $comment->getUser()) {
                    $showForm = true;
                    if (null !== $comment->getComment()) {
                        $content = htmlspecialchars($comment->getComment());
                    } else $content = "";

                    if (isset($_POST["comment"])) {
                        $prepare = CommentFactory::edit($comment, $_POST);
                        $status = $this->commentRepository->editComment($prepare);
                        header("Location: /p5/post/$postId");
                    }


                } else $showForm = false;
                require loadView('editComment.php');
            }
        }
}