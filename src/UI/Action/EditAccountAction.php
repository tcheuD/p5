<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\EditAccountActionInterface;
use App\Domain\Factory\UserFactory;
use App\Domain\Repository\AccountRepository;

require_once __DIR__ . './../../../etc/viewLoader.php';
require_once __DIR__.'/Interfaces/EditAccountActionInterface.php';


class EditAccountAction implements EditAccountActionInterface
{
    private $accountRepository;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
    }


    public function __invoke($id, array $request = [])
    {
        $account = $this->accountRepository->getUser($id);
        if (isset($_SESSION['id'])) {
            $admin = false;
            if ($id == intval($_SESSION['id'])) {
                $showForm = true;
            }
            if (CheckUserGroupAction::checkUserGroup()) {
                $admin = true;
                $showForm = true;
            }


                if ($account->getUsersGroup() !== null) {
                    if ($account->getUsersGroup() == 2) {
                        $usersGroupAdmin = "checked=\"checked\"";
                        $usersGroupMember = "";
                    } else {
                        $usersGroupAdmin = "";
                        $usersGroupMember = "checked=\"checked\"";
                    }
                } else $usersGroup = "";


                if ($account->getNickname() !== null) {
                    $userNickname = htmlspecialchars($account->getNickname());
                } else $userNickname = "lol";

                if ($account->getEmail()!== null) {
                    $userEmail = htmlspecialchars($account->getEmail());
                } else $userEmail = "";

                if (isset($_POST["nickname"], $_POST["email"])) {
                    if (isset($_POST["password"]) || isset($_POST["passwordConfirmation"])) {
                        if ($_POST["password"] === $_POST["passwordConfirmation"]) {
                            $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                        } else $passwordDontMatch = true;
                    } else $pass = $account->getPassword();

                    if (isset($pass)) {
                        if ($admin) {
                            $postUserGroups = $_POST["users_group"];
                        } else $postUserGroups = 1; //if the logged user isn't an admin, he can't change his own userGroups

                        $user = UserFactory::buildEdit($account, $_POST, $postUserGroups, $pass);
                        $status = $this->accountRepository->editAccount($user);
                    }
                }
            } else $showForm = false;

        require loadView('editAccount.php');
    }
}