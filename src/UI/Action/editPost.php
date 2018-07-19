<?php

require_once __DIR__.'./../../../config/templateLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function editPostPage(array $params, array $request = [])
{

    $id = $params[0];
    $post = getPost($id);
    if (verifyPostAuthor($post) || checkUserGroup()) {
    $showForm = TRUE;
    if(isset($post['title'])){
        $postTitle = htmlspecialchars($post['title']);
    } else $postTitle = "";

    if(isset($post['content'])){
        $postContent = htmlspecialchars($post['content']);
    } else $postContent = "";


    if (isset($_POST["title"], $_POST["content"])) {

            $status = editPost($_POST['title'], $_POST['content'], $id);
    } else echo "empty";

    } else $showForm = FALSE;

    require loadTemplate('editPost.php');
}