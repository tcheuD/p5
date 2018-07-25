<?php

require_once __DIR__ . './../../../config/viewLoader.php';
require_once __DIR__ . './../../../model/frontend.php';

function EditAccountPage(array $params, array $request = [])
{
    $id = $params[0];
    $account = getUser($id);
    if (isset($_SESSION['id'])) {
        if ($id == intval($_SESSION['id']) || checkUserGroup()) {
            $showForm = true;
            if (checkUserGroup()) {
                $admin = true;
            } else $admin = false;

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

            if (isset($_POST["nickname"], $_POST["email"])) {
                if (isset($_POST["password"]) || isset($_POST["passwordConfirmation"])) {
                    if ($_POST["password"] === $_POST["passwordConfirmation"]) {
                        $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    } else $passwordDontMatch = true;
                } else $pass = $account['password'];

                if (isset($pass)) {
                    if ($admin) {
                        $postUserGroups = $_POST["users_group"];
                    } else $postUserGroups = 1; //if the logged user isn't an admin, he can't change his own userGroups
                    $status = editAccount($postUserGroups, $_POST['nickname'], $_POST['email'], $pass, $id);
                }
            }
        } else $showForm = false;
    } else $showForm = false;

    require loadView('editAccount.php');
}