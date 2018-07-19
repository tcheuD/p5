<?php

require __DIR__.'./../../../model/frontend.php';
function listPosts()
{
    $post = getPosts();

    while ($donnees = $post->fetch()){
        echo 'auteur : '.$donnees['user_nickname'].", ".'identifiant :'.$donnees['id'].", ".'Titre : '.$donnees['title'].", ".'derniere modification : '.$donnees['modification_date']. "<br>";
    }
}