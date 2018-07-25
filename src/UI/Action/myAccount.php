<?php
require_once __DIR__ . './../../../model/frontend.php';
require_once __DIR__ . './../../../config/viewLoader.php';

function myAccountPage()
{
    $userId = $_SESSION['id'];
    $posts = showPostsUser($userId);
    require loadView('myAccount.php');
}

function showPostsUser($userId)
{
    $posts = getPostsByUserId($userId);
    $return = '';
    $space = ' ';
    while ($i = $posts->fetch()) {
        $return .= '<a href=../p5/editPost/' . $i["id"] . '>Edit</a>    
        <a href=../p5/deletePost/' . $i["id"] . '>Delete</a>' .
            $i["title"] . $space . $i["creation_date"] . $space . $i["status"] . '<br />';
    }
    return $return;
}
