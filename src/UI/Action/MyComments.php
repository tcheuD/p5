<?php

namespace App\UI\Action;

use App\Domain\Repository\CommentRepository;
use Core\Interfaces\RequestInterface;
use Core\Response;
use Core\Twig;

class MyComments
{

    private $commentRepository;
    private $twig;
    private $session;

    public function __construct()
    {
        $this->commentRepository = new CommentRepository();
        $this->twig = new Twig();
    }

    public function __invoke(RequestInterface $request)
    {

        $this->session = $request->getSession();

        $comments = $this->commentRepository->getCommentsByUserId($this->session->get('id'));

        return new Response($this->twig->getTwig($request)->render('myComments.html.twig', array('comments' => $comments)));
    }
}
