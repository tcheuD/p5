<?php

require_once __DIR__.'./../../../config/templateLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function addCommentPage(array $params, array $request = []) {
    $id = $params[0];
        postComment($id, $_SESSION['id'], $_POST["comment"]);

        header("Location: /p5/post/$id");
        exit;
}