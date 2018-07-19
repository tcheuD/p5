<?php
function adminPanel() {

    if(isset($_SESSION['users_group'])) {
        $usersGroup = $_SESSION['users_group'];
        if ($usersGroup == 2) {

            //TODO Overview : number of users, posts, number of ban
            $usersNumber = getUsersNumber();
            $postsNumber = getPostsNumber();

            echo "il y a $usersNumber utilisateurs inscrits et $postsNumber articles";

           //TODO link to Account Manager : add/remove/delete account/ChangeUserGroup


           //TODO link to Ban manager : ban/unban acc
        } else {
            echo "Vous n\'avez pas les droits nécessaires pour accéder a cette page";
        }
    }
}

function getUsersNumber(){
    $users = getUsers();

    $number = 0;
    while ($donnees = $users->fetch()) {
        $number++;
    }
    return $number;
}

function getPostsNumber(){
    $posts = getPosts();

    $post = 0;
    while ($donnees = $posts->fetch()) {
        $post++;
    }
    return $post;
}