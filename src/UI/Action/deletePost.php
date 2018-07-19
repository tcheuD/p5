<?php

require_once __DIR__.'./../../../config/templateLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function deletePostPage(array $params, array $request = []) {

    $id = $params[0];
    if (isset($id)) {
        $post = getPost($id);
        if(isset($_SESSION['id'], $post['user_id'])) {
            if ($_SESSION['id'] == $post['user_id']) {
                $status = deletePost($id);
            } else {
                echo "vous n\'avez pas les droits nécessaires pour supprimer ce post";
            }
        }
    }

    require loadTemplate('deletePost.php');
}

