<?php

function verifyPostAuthor($post)
{
    if (isset($post)) {
        if (isset($_SESSION['id'], $post['user_id'])) {
            if ($_SESSION['id'] == $post['user_id']) {
                $return = TRUE;
            } else {
                $return = FALSE;
            }
        } else $return = FALSE;
    }
    return $return;
}