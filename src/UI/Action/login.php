<?php
require_once __DIR__.'./../../../config/viewLoader.php';
require_once __DIR__.'./../../../config/ipChecker.php';

function login(array $request = []) {


    $deny_login = bruteCheck();
    if ($deny_login){
        echo "Login locked. Try again in 15 minutes";
    } else {
        if (isset($_POST["pseudo"], $_POST["password"])) {

            $pseudo = $_POST["pseudo"];
            $query = getUserByNickname($pseudo);
            $hashed_password = $query["password"];
            $password = password_verify($_POST['password'], $hashed_password);

            if ($password) {
                updateUser($pseudo);
                $_SESSION['nickname'] = $query["nickname"];
                $_SESSION['id'] = $query["id"];
                $_SESSION['users_group'] = $query["users_group"];
                $_SESSION['registration_date'] = $query["registration_date"];
                $_SESSION['last_connection'] = $query["last_connection"];
                $_SESSION['email'] = $query["email"];
                $_SESSION['password'] = $query["password"];
                $_SESSION['validation_token'] = $query["validation_token"];
                $_SESSION['status'] = TRUE;

                header("Location: /p5/");
            } else{
                bruteCheck(true);
                echo "Invalid username or password";
            }

        }
    }
    require loadView('login.php');

    return null;
}