<?php

namespace App\UI\Action;
use App\Domain\Repository\AccountRepository;
use App\UI\Action\Interfaces\RegistrationActionInterface;
use App\Domain\Model\User;
require_once __DIR__ . './../../../etc/viewLoader.php';
require_once __DIR__.'/Interfaces/RegistrationActionInterface.php';

class RegistrationAction implements RegistrationActionInterface
{
    private $accountRepository;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
    }


    public function __invoke(array $request = [])
    {
        if (isset($_POST["nickname"], $_POST["password"], $_POST["passwordConfirmation"], $_POST["email"])) {
            $users_group = 1;

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
                    $user = $this->setUser($_POST, $pass);
                    $status = $this->accountRepository->addAccount($user);
                    $alreadyExist = false;
                }
            }

        }
        require loadView('registration.php');
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




