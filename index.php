<?php
session_start();

define('MM_BRUTE_FILE', './var/cache/forbiddenIp.php');
define('MM_BRUTE_WINDOW', 15*60);
define('MM_BRUTE_ATTEMPTS', 5);

if(isset($_SESSION["nickname"])){
    echo "connecté en tant que " .$_SESSION["nickname"]."<br/>";
    echo "email : " .$_SESSION["email"]."<br/><br/>";
}

require __DIR__.'./config/Router.php';
handleRequest($_SERVER);