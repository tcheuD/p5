<?php

require_once __DIR__.'./../../../config/viewLoader.php';
require_once __DIR__.'./../../../model/frontend.php';
require_once __DIR__.'./../../../config/repositoryLoader.php';

function postPage(array $params, array $request = []) {
    $repository = getRepository('articleRepository');
    $id = $params[0];

    if(isset($_POST["comment"])){
        $sessionId = intval($_SESSION["id"]);
        addComment($id, $sessionId, $_POST["comment"]);
    }

    $donnee = getPost($id);
    $userNickname = htmlspecialchars($donnee['user_nickname']);
    $postTitle = htmlspecialchars($donnee['title']);
    $postContent = nl2br(htmlspecialchars($donnee['content']));
    if($donnee['modification_date'] !== null){
        $modificationDate = $donnee['modification_date'];
    } else $modificationDate = false;

    $intId = intval($id);
    $coms = showComments($intId);



    $showEditDelete = false;
    if(isset($_SESSION['nickname'])) {
        if ($_SESSION['nickname'] == $donnee['user_nickname'] || checkUserGroup()) {
            $showEditDelete = true;
        }
    }

    require loadView('post.php');
}

function showComments($id) {
     return getComments($id);
}
