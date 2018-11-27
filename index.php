<?php
require_once __DIR__.'./vendor/autoload.php';

use App\Kernel;
use Core\Request;
use Core\SessionHandler;

define('MM_BRUTE_FILE', './var/cache/forbiddenIp.php');
define('MM_BRUTE_WINDOW', 15*60);
define('MM_BRUTE_ATTEMPTS', 5);

$request = Request::createFromGlobals();
$kernel = new Kernel();
$response = $kernel->handle($request);
$response->send();
