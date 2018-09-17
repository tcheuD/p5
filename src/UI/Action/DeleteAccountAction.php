<?php

namespace App\UI\Action;

use App\Domain\Repository\AccountRepository;
use App\UI\Action\Interfaces\DeleteAccountActionInterface;

require_once __DIR__ . './../../../etc/viewLoader.php';
require_once __DIR__.'/Interfaces/DeleteAccountActionInterface.php';

class DeleteAccountAction implements DeleteAccountActionInterface
{
    private $accountRepository;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
    }

    public function __invoke($id, array $request = []) {
        $showForm = false;
        if (isset($_SESSION['id'])) {
            if ($id == intval($_SESSION['id']) || CheckUserGroupAction::checkUserGroup()) {
                $showForm = true;
                $user = $this->accountRepository->getUser($id);
                if (isset($_SESSION['id'])) {
                    $status = $this->accountRepository->deleteAccount($user);
                }
            }
        }
        require loadView('deleteAccount.php');
    }
}

