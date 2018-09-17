<?php
namespace App\UI\Action;
use Src\Comment;
use Src\CommentManager;

require_once __DIR__ . './../../../etc/viewLoader.php';

class AddComment {
    public function addComment($id, $sessionId, $comment) {
        $com = new Comment(['id' => $id, 'comment' => $comment]);
        $manager = new CommentManager();
        $manager->postComment($com);

        $commentManager = new CommentManager();
        $commentManager->postComment($id, $sessionId, $comment);
    }
}
