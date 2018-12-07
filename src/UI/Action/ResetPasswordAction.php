<?php

namespace App\UI\Action;

use App\Domain\Factory\UserFactory;
use App\Domain\Repository\AccountRepository;
use App\UI\Action\Interfaces\ResetPasswordActionInterface;
use Core\Interfaces\RequestInterface;
use Core\Mailer;
use Core\MailFactory;
use Core\Response;
use Core\Twig;

class ResetPasswordAction implements ResetPasswordActionInterface
{
    private $accountRepository;
    private $userFactory;
    private $session;
    private $twig;
    private $mailFactory;
    private $mailer;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
        $this->userFactory = new UserFactory();
        $this->twig = new Twig();
        $this->mailFactory = new MailFactory();
        $this->mailer = new Mailer();
    }

    public function __invoke(RequestInterface $request, $pass)
    {

        $showForm = false;
        $passwordDontMatch = false;

        $account = $this->accountRepository->getUserPassIdentity($pass);

        if ($account) {
            $showForm = true;

            if (isset($_POST["password"]) || isset($_POST["passwordConfirmation"])) {

                if ($_POST["password"] === $_POST["passwordConfirmation"]) {
                    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                } else {
                    $passwordDontMatch = true;
                }

                if (isset($pass)) {
                    $user = UserFactory::buildResetPassword($account, $pass);
                    $this->accountRepository->editAccount($user);
                }
            }
        }

        $this->session = $request->getRequestUri();

        return new Response($this->twig->getTwig($request)->render('resetPassword.html.twig', array(
            'id' => $pass,
            'showForm' => $showForm,
            'passwordDontMatch' => $passwordDontMatch
        )));
    }

}
