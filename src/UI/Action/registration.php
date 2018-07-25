<?php

require_once __DIR__ . './../../../config/viewLoader.php';
require_once __DIR__ . './../../../model/frontend.php';

function registrationPage(array $request = [])
{
    if (isset($_POST["nickname"], $_POST["password"], $_POST["passwordConfirmation"], $_POST["email"])) {
        $users_group = 1;

        if ($_POST["password"] === $_POST["passwordConfirmation"]) {
            $data = checkSignUpDataValidity($_POST["nickname"], $_POST["email"]);
            switch ($data) {
                case 0:
                    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $status = addAccount($users_group, $_POST["nickname"], $pass, $_POST["email"]);
                    $alreadyExist = false;
                    break;
                case 1:
                    $alreadyExist = true;
                    $alreadyExistValue = "Cette adresse email";
                    break;
                case 2:
                    $alreadyExist = true;
                    $alreadyExistValue = "Ce pseudo";
                    break;
                case 3:
                    $alreadyExist = true;
                    $alreadyExistValue = "L'adresse email et le pseudo";
                    break;
            }
        }

    }
    require loadView('registration.php');
}





