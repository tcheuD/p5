<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\AddAccountActionInterface;
use App\Domain\Repository\AccountRepository;
use App\Domain\Factory\UserFactory;
use Core\Twig;
use Core\Response;

class AddAccountAction implements AddAccountActionInterface
{
    private $accountRepository;
    private $twig;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
        $this->twig = new Twig();
    }

    public function __invoke($request)
    {
        if ($request->getSession()->isAdmin()) {
            $showForm = true;
            if (isset($_POST["nickname"], $_POST["users_group"], $_POST["password"], $_POST["passwordConfirmation"], $_POST["email"])) {
                if ($_POST["password"] === $_POST["passwordConfirmation"]) {
                    $_POST['users_group'] = intval($_POST['users_group']);
                    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $user = UserFactory::buildAccount($_POST, $pass);
                    $this->accountRepository->addAccount($user);
                }
            }
        } else $showForm = false;
        return new Response($this->twig->getTwig($request)->render('addAccount.html.twig', ['showForm' => $showForm]));
    }
}

