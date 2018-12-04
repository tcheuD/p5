<?php

namespace App\UI\Action;
use Core\Response;
use Core\Twig;

class NotFoundAction
{
    private $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function __invoke($request)
    {
        return new Response($this->twig->getTwig($request)->render('notFound.html.twig'));
    }
}
