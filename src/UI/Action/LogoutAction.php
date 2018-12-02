<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\LogoutActionInterface;


class LogoutAction implements LogoutActionInterface
{
    private $session;

    public function __invoke($request){
        $this->session = $request->getSession();
        $this->session->destroySession();
        header("Location: /");
    }
}
