<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\LoginActionInterface;
use App\Domain\Repository\AccountRepository;
use Core\IpChecker;
use Core\Interfaces\RequestInterface;
use Core\Response;
use Core\Twig;

class LoginAction implements LoginActionInterface
{
    private $accountRepository;
    private $ipChecker;
    private $session;
    private $twig;
    private $cooldown = false;
    private $incorrectInfos = false;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
        $this->ipChecker = new IpChecker();
        $this->twig = new Twig();
    }

    public function __invoke(RequestInterface $request) {

        $this->session = $request->getSession();

        $deny_login = $this->ipChecker::bruteCheck();
        if ($deny_login){
            $this->cooldown = true;
        } else {
            if (isset($_POST["nickname"], $_POST["password"])) {

                $pseudo = $_POST["nickname"];
                $query = $this->accountRepository->getUserByNickname($pseudo);

                if ($query) {
                    $hashed_password = $query->getPassword();
                    $password = password_verify($_POST['password'], $hashed_password);
                    if ($password) {
                        $this->accountRepository->updateUser($query);

                        $this->session->set('nickname', $query->getNickname());
                        $this->session->set('id', $query->getId());
                        $this->session->set('users_group', $query->getUsersGroup());
                        $this->session->set('registration_date', $query->getRegistrationDate());
                        $this->session->set('last_connection', $query->getLastConnection());
                        $this->session->set('email', $query->getEmail());
                        $this->session->setToken();

                        header(sprintf("Location: %s", "/"));
                        exit();
                    }
                } else{
                    $this->ipChecker->bruteCheck(true);
                    $this->incorrectInfos = true;
                }
            }
        }
        return new Response($this->twig->getTwig($request)->render('login.html.twig',
            array('incorrectInfos' => $this->incorrectInfos,
                'cooldown' => $this->cooldown)));
    }

}
