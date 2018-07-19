<?php

require_once __DIR__.'./../../../config/templateLoader.php';
require_once __DIR__.'./../../../model/frontend.php';
require_once __DIR__.'./../../../config/repositoryLoader.php';

function postPage(array $params, array $request = []) {
    $repository = getRepository('articleRepository');
    $id = $params[0]; /* This one works*/

    if(isset($_POST["comment"])){
        $sessionId = intval($_SESSION["id"]);
        addComment($id, $sessionId, $_POST["comment"]);
    }



    $donnee = getPost($id);
    $post = 'auteur : '.$donnee['user_nickname'].", ".'identifiant :'.$id.", ".'Titre : '.$donnee['title'].", ".'derniere modification : '.$donnee['modification_date']. "<br /> <p>" .nl2br($donnee['content'])."</p>";

    if(isset($_SESSION['nickname'])){


        if($_SESSION['nickname'] == $donnee['user_nickname']){
            echo "<a href=../editPost/".$id.">Edit</a>";
            echo "<a href=../deletePost/".$id.">Delete</a> <br>";
        }
    }

    $intId = intval($id);
    $coms = showComments($intId);

    require loadTemplate('post.php');
}

function showComments($id) {
     $comments = getComments($id);
     $result='';
    while ($i = $comments->fetch()) {
        $result .= '<a href=../editComment/'.$i["c_comment_id"].'>Edit</a>    <a href=../deleteComment/'.$i["c_comment_id"].'>Delete</a>    user : '.$i["user_nickname"].' message : ' .$i["comment"].'<br />';
    }
    return $result;
}


function addComment($id, $userId, $content) {
    postComment($id, $userId, $content);
}

