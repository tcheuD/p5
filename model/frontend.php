<?php
function getPosts()
{

}

function getPost($postId)
{

}

function getComments($postId)
{

}

function postComment($postId)
{

}

function dbConnect()
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=p5;charset=utf-8', 'root', '');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}