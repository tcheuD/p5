<?php
require __DIR__.'./../../../config/viewLoader.php';

function home(){
    $post = listPosts();
    require loadView('index.php');
}