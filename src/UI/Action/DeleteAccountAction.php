<?php

namespace App\UI\Action;

use App\Domain\Repository\AccountRepository;
use App\Domain\Repository\CommentRepository;
use App\Domain\Repository\PostRepository;
use App\UI\Action\Interfaces\DeleteAccountActionInterface;
use Core\Response;
use Core\Twig;

class DeleteAccountAction implements DeleteAccountActionInterface
{
    private $accountRepository;
    private $postRepository;
    private $commentRepository;
    private $session;
    private $twig;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
        $this->postRepository = new PostRepository();
        $this->commentRepository = new CommentRepository();
        $this->twig = new Twig();
    }

    public function __invoke($request, $id) {

        $this->session = $request->getSession();

        $showForm = false;

        if ($this->session->parameterExist('id')) {

            if ($id == intval($this->session->get('id')) || $this->session->isAdmin()) {
                $showForm = true;
                $userId = $this->session->get('id');

                if (isset($_POST['password'])) {

                    $query = $this->accountRepository->getUser($userId);
                    $hashed_password = $query->getPassword();
                    $password = password_verify($_POST['password'], $hashed_password);

                    if ($password) {
                        $user = $this->accountRepository->getUser($id);
                        $this->postRepository->deleteAllFromUser($id);
                        $this->commentRepository->deleteAllFromUser($id);
                        $this->accountRepository->deleteAccount($user);
                        $this->session->destroySession();
                        header("Location: /p5/");
                }
            }
        }
            return new Response($this->twig->getTwig($request)->render('deleteAccount.html.twig', array(
                'showForm' => $showForm,
                'id' => $id)));
    }
}
}
