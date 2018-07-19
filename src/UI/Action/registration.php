<?php

require_once __DIR__.'./../../../config/templateLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function registrationPage(array $request = []) {
        if (isset($_POST["nickname"], $_POST["password"], $_POST["passwordConfirmation"], $_POST["email"])) {
        $users_group = 1;

            if ($_POST["password"] === $_POST["passwordConfirmation"]) {
                $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $status = addAccount($_POST["nickname"], $pass, $users_group, $_POST["email"]);
            }
        }
        require loadTemplate('registration.php');
    }





