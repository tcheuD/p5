<?php

require_once __DIR__.'./../../../config/viewLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function EditCommentPage(array $params, array $request = [])
{
    $id = $params[0];
    $comment = getComment($id);
    $postId = $comment["post_id"];
    if (verifyPostAuthor($comment) || checkUserGroup()) {
        $showForm = true;
        if (isset($comment['comment'])) {
            $content = htmlspecialchars($comment['comment']);
        } else $content = "";

        if (isset($_POST["comment"])) {
            $status = editComment($_POST['comment'], $id);
            header("Location: /p5/post/$postId");
        }


    } else $showForm = false;
    require loadView('editComment.php');
}