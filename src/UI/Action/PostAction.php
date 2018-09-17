<?php

namespace App\UI\Action;
use App\Domain\Model\Comment;
use App\Domain\Repository\PostRepository;
use App\Domain\Repository\CommentRepository;
use App\UI\Action\Interfaces\PostActionInterface;
use App\Domain\Repository\AccountRepository;
use App\Domain\Factory\CommentFactory;

require_once __DIR__ .'./../../../etc/viewLoader.php';

class PostAction implements PostActionInterface
{
    private $postRepository;
    private $accountRepository;
    private $commentRepository;
    public function __construct()
    {
        $this->postRepository = new PostRepository();
        $this->accountRepository = new AccountRepository();
        $this->commentRepository = new CommentRepository();
    }

    public function __invoke($id, array $request = [])
    {
        $id;
        $post = $this->postRepository->getPost($id);

        $coms = $this->commentRepository->getComments($id);

        if (isset($_SESSION['id'])) {
            $showForm = true;

            if (isset($_POST["comment"])) {
                $comment = CommentFactory::add($_POST, $id);
                $status = $this->commentRepository->postComment($comment);
                header("refresh:0");
                exit;
            }

        }
        require loadView('post.php');
    }
}