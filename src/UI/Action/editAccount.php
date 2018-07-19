<?php

require_once __DIR__.'./../../../config/templateLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function EditAccountPage(array $params, array $request = [])
{
    $id = $params[0];
    $account = getUser($id);

    if (isset($account['users_group'])) {
        $usersGroup = intval($account['users_group']);
        if ($usersGroup == 2) {
            $usersGroupAdmin = "checked=\"checked\"";
            $usersGroupMember = "";
        } else {
            $usersGroupAdmin = "";
            $usersGroupMember = "checked=\"checked\"";
        }
    } else $usersGroup = "";

    if (isset($account['nickname'])) {
        $userNickname = htmlspecialchars($account['nickname']);
    } else $userNickname = "lol";

    if (isset($account['email'])) {
        $userEmail = htmlspecialchars($account['email']);
    } else $userEmail = "";

    if (isset($_POST["users_group"], $_POST["nickname"], $_POST["email"], $_POST["password"])) {
        if ($_POST["password"] === $_POST["passwordConfirmation"]) {
            $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $status = editAccount($_POST['users_group'], $_POST['nickname'], $_POST['email'], $pass, $id);
        }
    }

    require loadTemplate('editAccount.php');
}