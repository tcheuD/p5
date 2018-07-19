<?php

require __DIR__.'./../src/UI/Action/home.php';
require __DIR__.'./../src/UI/Action/contact.php';
require __DIR__.'./../src/UI/Action/listPosts.php';
require __DIR__.'./../src/UI/Action/addPost.php';
require __DIR__.'./../src/UI/Action/registration.php';
require __DIR__.'./../src/UI/Action/deletePost.php';
require __DIR__.'./../src/UI/Action/editPost.php';
require __DIR__.'./../src/UI/Action/login.php';
require __DIR__.'./../src/UI/Action/post.php';
require __DIR__.'./../src/UI/Action/logout.php';
require __DIR__.'./../src/UI/Action/adminPanel.php';
require __DIR__.'./../src/UI/Action/addAccount.php';
require __DIR__.'./../src/UI/Action/editAccount.php';
require __DIR__.'./../src/UI/Action/deleteAccount.php';
require __DIR__.'./../src/UI/Action/editComment.php';
require __DIR__.'./../src/UI/Action/deleteComment.php';
require __DIR__.'./../src/UI/Action/checkUserGroup.php';
require __DIR__.'./../src/UI/Action/verifyPostAuthor.php';

function resolveAction(string $action, array $params = []) {
    call_user_func($action, $params);
}