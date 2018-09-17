<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\LogoutActionInterface;
require_once __DIR__.'/Interfaces/LogoutActionInterface.php';


class LogoutAction implements LogoutActionInterface
{
    public function __invoke(){
        echo 'déco';
        session_destroy();
    }
}
