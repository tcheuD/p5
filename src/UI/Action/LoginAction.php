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
            if (isset($_POST["pseudo"], $_POST["password"])) {

                $pseudo = $_POST["pseudo"];
                $query = $this->accountRepository->getUserByNickname($pseudo);
                $hashed_password = $query->getPassword();
                $password = password_verify($_POST['password'], $hashed_password);
//TODO: abort when username dont exist
                if ($password) {
                    $this->accountRepository->updateUser($query);

                    $this->session->set('nickname', $query->getNickname());
                    $this->session->set('id', $query->getId());
                    $this->session->set('users_group', $query->getUsersGroup());
                    $this->session->set('registration_date', $query->getRegistrationDate());
                    $this->session->set('last_connection', $query->getLastConnection());
                    $this->session->set('email', $query->getEmail());

                    header("Location:/p5/");
                    exit;
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