<?php

require_once __DIR__.'./../../../config/viewLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function addPostPage(array $request = [])
{
    //TODO link to a function to prevent flood for addPost & addComment
    if (isset($_SESSION['id'])) {
    $showForm = true;

    if (isset($_POST["title"]) && isset($_POST["content"])) {
        $status = addPost($_POST['title'], $_POST['content'], $_SESSION['id']);
        header("Location: post/$status");
        exit;

    }
} else $showForm = false;
    require loadView('addPost.php');
}