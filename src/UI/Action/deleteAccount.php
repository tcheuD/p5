<?php

require_once __DIR__.'./../../../config/templateLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function deleteAccountPage(array $params, array $request = []) {

    $id = $params[0];
    if (isset($id)) {
        $user = getUser($id);
        if(isset($_SESSION['id'])) {
            echo "lulz";
                $status = deleteAccount($id);
            }
        }

    require loadTemplate('deleteAccount.php');
}

