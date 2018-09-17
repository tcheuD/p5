<?php

namespace App\UI\Action;

class CheckUserGroupAction{
    public static function checkUserGroup() {
        if (isset($_SESSION["users_group"])){
            $userGroup = intval($_SESSION["users_group"]);
            if ($userGroup == 2){
                $isAdmin = true;
            } else $isAdmin = false;

        } else $isAdmin = FALSE;
        return $isAdmin;
    }
}
