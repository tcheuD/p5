<?php

namespace App\UI\Action;
use App\UI\Action\Interfaces\NotFoundActionInterface;
use Core\Interfaces\RequestInterface;
use Core\Response;
use Core\Twig;

class NotFoundAction implements NotFoundActionInterface
{
    private $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function __invoke(RequestInterface $request)
    {
        return new Response($this->twig->getTwig($request)->render('notFound.html.twig'));
    }
}
