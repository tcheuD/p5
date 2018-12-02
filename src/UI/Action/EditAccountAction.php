<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\EditAccountActionInterface;
use App\Domain\Factory\UserFactory;
use App\Domain\Repository\AccountRepository;
use Core\Response;
use Core\Twig;

class EditAccountAction implements EditAccountActionInterface
{
    private $accountRepository;
    private $session;
    private $twig;
    private $passwordDontMatch = false;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
        $this->twig = new Twig();
    }


    public function __invoke($request, $id)
    {

        $this->session = $request->getSession();
        $account = $this->accountRepository->getUser($id);

        if (!\is_null($account->getUsersGroup())) {
            if ($account->getUsersGroup() == 2) {
                $usersGroupAdmin = "checked=\"checked\"";
                $usersGroupMember = "";
            } else {
                $usersGroupAdmin = "";
                $usersGroupMember = "checked=\"checked\"";
            }
        }

        if (isset($_POST["nickname"], $_POST["email"])) {

            if (isset($_POST["password"]) || isset($_POST["passwordConfirmation"])) {

                if ($_POST["password"] === $_POST["passwordConfirmation"]) {
                    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                } else {
                    $this->passwordDontMatch = true;
                }

            } else {
                $pass = $account->getPassword();
            }

            if (isset($pass)) {

                $user = UserFactory::buildEdit($account, $_POST, $pass);
                $this->accountRepository->editAccount($user);
            }
        }

        return new Response($this->twig->getTwig($request)->render('editAccount.html.twig', array(
            'id' => $id,
            'usersGroupMember' => $usersGroupMember,
            'usersGroupAdmin' => $usersGroupAdmin,
            'passwordDontMatch' => $this->passwordDontMatch,
            'account' => $account
        )));
    }
}
