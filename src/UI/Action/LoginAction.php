<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\LoginActionInterface;
use App\Domain\Repository\AccountRepository;
use Core\IpChecker;
require_once __DIR__.'./../../../etc/viewLoader.php';


class LoginAction implements LoginActionInterface
{
    private $accountRepository;
    private $ipChecker;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
        $this->ipChecker = new IpChecker();
    }

    public function __invoke(array $request = []) {

        $deny_login = $this->ipChecker::bruteCheck();
        if ($deny_login){
            echo "bloqué 15min";
        } else {
            if (isset($_POST["pseudo"], $_POST["password"])) {

                $pseudo = $_POST["pseudo"];
                $query = $this->accountRepository->getUserByNickname($pseudo);
                $hashed_password = $query->getPassword();
                $password = password_verify($_POST['password'], $hashed_password);

                if ($password) {
                    $this->accountRepository->updateUser($query);
                    $_SESSION['nickname'] = $query->getNickname();
                    $_SESSION['id'] = $query->getId();
                    $_SESSION['users_group'] = $query->getUsersGroup();
                    $_SESSION['registration_date'] = $query->getRegistrationDate();
                    $_SESSION['last_connection'] = $query->getLastConnection();
                    $_SESSION['email'] = $query->getLastConnection();
                    $_SESSION['status'] = TRUE;

                    header("Location: /p5/");
                } else{
                    $this->ipChecker->bruteCheck(true);
                    echo "Nom d'utilisateur ou mot de passe incorrect";
                }

            }
        }
         require loadView('Login.php');

        return null;
    }

}