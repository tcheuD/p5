<?php

namespace App\UI\Action;

use Core\Interfaces\RequestInterface;
use Core\Mailer;
use Core\MailFactory;
use Core\Response;
use Core\Twig;

class ContactAction
{
    private $accountRepository;
    private $userFactory;
    private $session;
    private $twig;
    private $mailFactory;
    private $mailer;

    public function __construct()
    {
        $this->twig = new Twig();
        $this->mailFactory = new MailFactory();
        $this->mailer = new Mailer();
    }

    public function __invoke(RequestInterface $request)
    {
        $this->session = $request->getRequestUri();

        if (isset($_POST["email"])) {

            if (isset($_POST['mail'], $_POST['name'], $_POST['content'])) {

                $mail = $this->mailFactory::contact($_POST['mail'], $_POST['name'], $_POST['content']);
                $this->mailer->sendMail($mail);
            }
        }

        return new Response($this->twig->getTwig($request)->render('contact.html.twig'));
    }

}
