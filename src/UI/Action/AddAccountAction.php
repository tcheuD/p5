<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\AddAccountActionInterface;
use App\Domain\Repository\AccountRepository;
use App\Domain\Factory\UserFactory;

require_once __DIR__.'./../../../etc/viewLoader.php';
require_once __DIR__.'/Interfaces/AddAccountActionInterface.php';


class AddAccountAction implements AddAccountActionInterface
{
    public $accountRepository;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
    }

    public function __invoke(array $request = [])
    {
        $isAdmin = CheckUserGroupAction::checkUserGroup();


        var_dump($isAdmin);
        if ($isAdmin) {
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
        require_once loadView('AddAccount.php');
    }
}

