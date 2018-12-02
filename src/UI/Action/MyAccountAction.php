<?php

namespace App\UI\Action;

use App\Domain\Repository\AccountRepository;
use App\Domain\Repository\CommentRepository;
use App\Domain\Repository\PostRepository;
use Core\Response;
use Core\Twig;

class MyAccountAction
{
    private $user;
    private $posts;
    private $comments;
    private $session;
    private $twig;

    public function __construct()
    {
        $this->user = new AccountRepository();
        $this->posts = new PostRepository();
        $this->comments = new CommentRepository();
        $this->twig = new Twig();
    }

    public function __invoke($request)
    {
        $this->session = $request->getSession();
        $posts = $this->posts->getPostsByUserId($this->session->get('id'));
        $postsNumber = $this->countPostsAndComs($posts);

        $comments = $this->comments->getCommentsByUserId($this->session->get('id'));
        $commentsNumber = $this->countPostsAndComs($comments);

        return new Response($this->twig->getTwig($request)->render('myAccount.html.twig',
            array('postsNumber' => $postsNumber, 'commentsNumber' => $commentsNumber)));
    }

    public function countPostsAndComs($datas)
    {
        $number = 0;

        foreach ($datas as $data) {
            $number++;
        }

        return $number;
    }
}
