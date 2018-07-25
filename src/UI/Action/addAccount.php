<?php

require_once __DIR__.'./../../../config/viewLoader.php';
require_once __DIR__.'./../../../model/frontend.php';


function addAccountPage(array $request = [])
{
    $isAdmin = checkUserGroup();
    if ($isAdmin) {
        $showForm = true;
        if (isset($_POST["nickname"], $_POST["users_group"], $_POST["password"], $_POST["passwordConfirmation"], $_POST["email"])) {
            if ($_POST["password"] === $_POST["passwordConfirmation"]) {
                $_POST['users_group'] = intval($_POST['users_group']);
                $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $status = addAccount($_POST["users_group"], $_POST["nickname"], $pass, $_POST["email"]);
            }
        }
    } else $showForm = false;
    require_once loadView('addAccount.php');
}