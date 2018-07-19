<?php

require __DIR__.'./../../../model/frontend.php';
function listPosts()
{
    $post = getPosts();
    $posts = '';
    while ($donnees = $post->fetch()){
        $posts .= '<a href=/p5/post/'.$donnees['id'].'> auteur : '.$donnees['user_nickname'].", ".'identifiant :'.$donnees['id'].", ".'Titre : '.$donnees['title'].", ".'derniere modification : '.$donnees['modification_date']. "</a><br>";
    }
    return $posts;
}