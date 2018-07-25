<?php

require_once __DIR__.'./../../../config/viewLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function deleteCommentPage(array $params, array $request = []) {

    $id = $params[0];
    if (isset($_SESSION["id"])) {

        $comment = getComment($id);
        $postId = $comment["post_id"];

        if(isset($_SESSION['id'], $comment['user_id'])) {

            if (intval($_SESSION['id']) == $comment['user_id']) {

                $status = deleteComment($id);
                header("Location: /p5/post/$postId");
            }
        } else {
            echo "vous n\'avez pas les droits nécessaires pour supprimer ce post";
        }
    }

    require loadView('deleteComment.php');
}
?>
