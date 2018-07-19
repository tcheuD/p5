<?php

require_once __DIR__.'./../../../config/templateLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function addPostPage(array $request = [])
{
    if (isset($_POST["title"]) && isset($_POST["content"])) {
        $status = addPost($_POST['title'], $_POST['content'], $_SESSION['id']);
        header("Location: post/$status");
        exit;

    }
    require loadTemplate('addPost.php');
}