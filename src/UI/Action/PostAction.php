<?php

namespace App\UI\Action;

use App\Domain\Repository\PostRepository;
use App\Domain\Repository\CommentRepository;
use App\UI\Action\Interfaces\PostActionInterface;
use App\Domain\Repository\AccountRepository;
use App\Domain\Factory\CommentFactory;
use Core\Interfaces\RequestInterface;
use Core\Response;
use Core\Twig;

class PostAction implements PostActionInterface
{
    private $postRepository;
    private $accountRepository;
    private $commentRepository;
    private $twig;
    private $session;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
        $this->accountRepository = new AccountRepository();
        $this->commentRepository = new CommentRepository();
        $this->twig = new Twig();
    }

    public function __invoke(RequestInterface $request, $id)
    {

        $post = $this->postRepository->getPost($id);
        $this->session = $request->getSession();

        $coms = $this->commentRepository->getComments($id);

            if (isset($_POST["comment"])) {
                $comment = CommentFactory::add($_POST, $id, $this->session->get('id'));

                $this->commentRepository->postComment($comment);
                header("refresh:0");
                exit();
            }

        return new Response($this->twig->getTwig($request)->render('post.html.twig',
            array('post' => $post, 'id' => $id, 'coms' => $coms)));
    }
}
