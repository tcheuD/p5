<?php

namespace App\UI\Action;

use App\Domain\Factory\UserFactory;
use App\Domain\Repository\AccountRepository;
use Core\IpChecker;
use Core\Interfaces\RequestInterface;
use Core\Mailer;
use Core\MailFactory;
use Core\Response;
use Core\Twig;

class ForgotPassword
{
    private $accountRepository;
    private $userFactory;
    private $ipChecker;
    private $session;
    private $twig;
    private $cooldown = false;
    private $mailFactory;
    private $mailer;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
        $this->userFactory = new UserFactory();
        $this->ipChecker = new IpChecker();
        $this->twig = new Twig();
        $this->mailFactory = new MailFactory();
        $this->mailer = new Mailer();
    }

    public function __invoke(RequestInterface $request)
    {
        $this->session = $request->getRequestUri();

        if (isset($_POST["email"])) {

            $userMail = $this->accountRepository->checkEmail($_POST["email"]);

            if ($userMail) {
                $bytes = random_bytes(10);
                $int = bin2hex($bytes);

                $user = $this->userFactory::buildSetPassIdentity($userMail, $int);

                $this->accountRepository->setUserPassIdentity($user);

                $mail = $this->mailFactory::resetPassword($_POST["email"], $int);
                $this->mailer->sendMail($mail);
            }
        }

        return new Response($this->twig->getTwig($request)->render('forgotPassword.html.twig'));
    }

}