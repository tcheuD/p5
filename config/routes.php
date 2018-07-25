<?php

return [
    'homepage' => [
        'path' => '/p5/',
        'method' => ['GET'],
        'action' => 'home'
    ],

    'adminPanel' => [
        'path' => '/p5/admin',
        'method' => ['GET', 'POST'],
        'action' => 'adminPanel'
    ],

    'addAccount' => [
        'path' => '/p5/admin/add-account',
        'method' => ['GET', 'POST'],
        'action' => 'addAccountPage',
        'params' =>['nickname' => 'char', 'users_group' => 'int', 'email' => 'varchar', 'password' => 'char']
    ],

    'EditAccount' => [
        'path' => '/p5/edit-account/{id}',
        'method' => ['GET', 'POST'],
        'action' => 'EditAccountPage',
        'params' =>['id' => '(\d+)', 'nickname' => 'char', 'users_group' => 'var', 'email' => 'varchar', 'password' => 'char']
    ],

    'deleteAccount' => [
        'path' => '/p5/delete-account/{id}',
        'method' => ['GET', 'POST'],
        'action' => 'deleteAccountPage',
        'params' =>['id' => '(\d+)']
    ],

    'contactPage' => [
       'path' => '/p5/contact',
       'method' => ['GET'],
       'action' => 'contact'
    ],

    'logoutPage' => [
        'path' => '/p5/logout',
        'method' => ['GET'],
        'action' => 'logout'
    ],

    'postDetails' => [
        'path' => '/p5/post/{id}',
        'method' => ['GET', 'POST'],
        'action' => 'postPage',
        'params' => ['id' => '(\d+)', 'comment' => 'varchar']
    ],

    'listPostsPage' => [
        'path' => '/p5/listPosts/',
        'method' => ['GET', 'POST'],
        'action' => 'listPosts'
    ],

    'myAccount' => [
        'path' => '/p5/myAccount',
        'method' => ['GET', 'POST'],
        'action' => 'myAccountPage'
    ],

    'addNewPost' => [
        'path' => '/p5/addPost',
        'method' => ['GET', 'POST'],
        'action' => 'addPostPage',
        'params' =>['titre' => 'char', 'content' => 'varchar']
    ],

    'registrationPage' =>[
        'path' => '/p5/registration',
        'method' => ['GET', 'POST'],
        'action' => 'registrationPage',
        'params' =>['nickname' => 'char', 'email' => 'varchar', 'password' => 'char']
    ],


    'deletePost' => [
        'path' => '/p5/deletePost/{id}',
        'method' => ['GET', 'POST'],
        'action' => 'deletePostPage',
        'params' =>['id' => '(\d+)']
    ],

    'deleteComment' => [
        'path' => '/p5/deleteComment/{id}',
        'method' => ['GET', 'POST'],
        'action' => 'deleteCommentPage',
        'params' =>['id' => '(\d+)']
    ],

    'editPost' => [
        'path' => '/p5/editPost/{id}',
        'method' => ['GET', 'POST'],
        'action' => 'editPostPage',
        'params' =>['id' => '(\d+)', 'titre' => 'char', 'content' => 'varchar']
    ],

    'editComment' => [
        'path' => '/p5/editComment/{id}',
        'method' => ['GET', 'POST'],
        'action' => 'EditCommentPage',
        'params' =>['id' => '(\d+)', 'content' => 'varchar']
    ],


    'login' => [
        'path' => '/p5/login',
        'method' => ['GET', 'POST'],
        'action' => 'login',
        'params' =>['pseudo' => 'char', 'password' => 'char']
    ]
];
   // 'article_details' => [
     //   'path' => '/article/details/{id}',
       // 'method' => ['GET', 'POST'],
       // '//action' => 'getArticleDetails(int $id)',
       // 'params' => ['id' => 'string']
   // ]
