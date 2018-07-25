<?php

require_once __DIR__.'./../../../config/viewLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function deleteAccountPage(array $params, array $request = []) {
    $showForm = false;
    $id = $params[0];
        if (isset($_SESSION['id'])) {
            if ($id == intval($_SESSION['id']) || checkUserGroup()) {
            $showForm = true;
            $user = getUser($id);
            if (isset($_SESSION['id'])) {
                $status = deleteAccount($id);
            }
        }
    }
    require loadView('deleteAccount.php');
}

