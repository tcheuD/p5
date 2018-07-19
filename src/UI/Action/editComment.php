<?php

require_once __DIR__.'./../../../config/templateLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function EditCommentPage(array $params, array $request = [])
{
    $id = $params[0];
    $comment = getComment($id);

    if (isset($comment['comment'])) {
        $content = htmlspecialchars($comment['comment']);
    } else $content = "";

    if (isset($_POST["comment"])) {
            $status = editComment($_POST['comment'], $id);
        }

    require loadTemplate('editComment.php');
}