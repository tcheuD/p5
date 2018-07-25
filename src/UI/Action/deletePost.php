<?php

require_once __DIR__.'./../../../config/viewLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function deletePostPage(array $params, array $request = []) {

    $id = $params[0];
    $post = getPost($id);
    if (verifyPostAuthor($post) || checkUserGroup()) {
        $showForm = TRUE;
        if (isset($_SESSION['id'], $post['user_id'])) {
            if ($_SESSION['id'] == $post['user_id']) {
                $status = deletePost($id);
                header("Location: /p5/");
            }
        }
    } else $showForm = false;

    require loadView('deletePost.php');
}

