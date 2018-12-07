<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\ContactActionInterface;
use Core\Interfaces\RequestInterface;
use Core\Mailer;
use Core\MailFactory;
use Core\Response;
use Core\Twig;

class ContactAction implements ContactActionInterface
{
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
        $sent = false;

            if (isset($_POST['email'], $_POST['name'], $_POST['content'])) {

                $mail = $this->mailFactory::contact($_POST['email'], $_POST['name'], $_POST['content']);
                $this->mailer->sendMail($mail);
                $sent = true;
            }

        return new Response($this->twig->getTwig($request)->render('contact.html.twig', array('sent' => $sent)));
    }

}
