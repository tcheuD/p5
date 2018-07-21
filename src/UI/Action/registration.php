<?php

require_once __DIR__.'./../../../config/templateLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function registrationPage(array $request = []) {
        if (isset($_POST["nickname"], $_POST["password"], $_POST["passwordConfirmation"], $_POST["email"])) {
        $users_group = 1;

            if ($_POST["password"] === $_POST["passwordConfirmation"]) {
                $data = checkSignUpDataValidity($_POST["nickname"], $_POST["email"]);
                if (!$data){
                    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $status = addAccount($users_group, $_POST["nickname"], $pass, $_POST["email"]);
                    $alreadyExist = false;
                } else {
                    $alreadyExist = true;
                }

            }
        }
        require loadTemplate('registration.php');
    }





