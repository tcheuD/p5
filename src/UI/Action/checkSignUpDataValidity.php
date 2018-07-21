<?php

//TODO if true, precise wich one is already used
function checkSignUpDataValidity($nickname, $email){
$response = checkIfUserAlreadyExist($nickname, $email);
return $response;
}