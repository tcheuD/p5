<?php

namespace App\UI\Action;

use App\Domain\Repository\CommentRepository;
use App\UI\Action\Interfaces\DeleteCommentActionInterface;

require_once __DIR__ . './../../../etc/viewLoader.php';

class DeleteCommentAction implements DeleteCommentActionInterface
{
    private $commentRepository;

    public function __construct()
    {
        $this->commentRepository = new CommentRepository();
    }

    public function __invoke($params, array $request = [])
    {
        $id = $params;
        if (isset($_SESSION["id"])) {

            $comment = $this->commentRepository->getComment($id);

            if (isset($_SESSION['id'])) {

                if (intval($_SESSION['id']) == $comment->getUser()) {

                    $status = $this->commentRepository->deleteComment($id);
                    $postId = $comment->getPostId();
                    header("Location: /p5/post/$postId");
                }
            } else {
                echo "vous n\'avez pas les droits nécessaires pour supprimer ce post";
            }
        }

        require loadView('DeleteCommentAction.php');
    }
}

?>

