<?php

require_once __DIR__.'./../../../config/templateLoader.php';
require_once __DIR__.'./../../../model/frontend.php';

function addComment($id, $sessionId, $comment) {
        postComment($id, $sessionId, $comment);
}