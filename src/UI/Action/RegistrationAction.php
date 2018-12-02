<?php

namespace App\UI\Action;
use App\Domain\Factory\UserFactory;
use App\Domain\Repository\AccountRepository;
use App\UI\Action\Interfaces\RegistrationActionInterface;
use App\Domain\Model\User;
use Core\Response;
use Core\Twig;

class RegistrationAction implements RegistrationActionInterface
{
    private $accountRepository;
    private $userFactory;
    private $twig;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
        $this->userFactory = new UserFactory();
        $this->twig = new Twig();
    }


    public function __invoke($request)
    {
        $alreadyExist = false;
        $alreadyExistValue = false;

        if (isset($_POST["nickname"], $_POST["password"], $_POST["passwordConfirmation"], $_POST["email"])) {

            if ($_POST["password"] === $_POST["passwordConfirmation"]) {

                $mail = $this->accountRepository->checkEmail($_POST["email"]);
                $alias = $this->accountRepository->checkNickname($_POST["nickname"]);

                if ($alias && $mail) {
                    $alreadyExist = true;
                    $alreadyExistValue = "L'adresse email et le pseudo";
                } elseif ($mail) {
                    $alreadyExist = true;
                    $alreadyExistValue = "Cette adresse email";
                } elseif ($alias) {
                    $alreadyExist = true;
                    $alreadyExistValue = "Ce pseudo";
                } else {
                    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $this->setUser($_POST, $pass);
                    $user = $this->userFactory::buildRegistration($_POST, $pass);
                    $this->accountRepository->addAccount($user);
                    $alreadyExist = false;
                }
            }
        }
        return new Response($this->twig->getTwig($request)->render('registration.html.twig',
            array('alreadyExist' => $alreadyExist, 'alreadyExistValue' => $alreadyExistValue)));
    }

    public function setUser($data, $pass)
    {
        $user = new User();
        $user->setUsersGroup(1);
        $user->setNickname($data["nickname"]);
        $user->setPassword($pass);
        $user->setEmail($data["email"]);
        return $user;
    }
}
