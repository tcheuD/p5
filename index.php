<?php

session_start();

require_once __DIR__.'./vendor/autoload.php';

use App\Kernel;
use Core\Request;
use Core\Router;

define('MM_BRUTE_FILE', './var/cache/forbiddenIp.php');
define('MM_BRUTE_WINDOW', 15*60);
define('MM_BRUTE_ATTEMPTS', 5);

if(isset($_SESSION["nickname"])){
    echo "connecté en tant que " .$_SESSION["nickname"]."<br/>";
    echo "email : " .$_SESSION["email"]."<br/><br/>";
}

$request = Request::createFromGlobals();
$kernel = new Kernel();
$kernel->handle($request);
