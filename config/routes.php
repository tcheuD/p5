<?php

return [
    'homepage' => [
        'path' => '/p5/',
        'methods' => ['GET'],
        'action' => 'App\UI\Action\HomeAction'
    ],

    'adminPanel' => [
        'path' => '/p5/admin',
        'methods' => ['GET', 'POST'],
        'action' => 'adminPanel'
    ],

    'addAccount' => [
        'path' => '/p5/admin/add-account',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\AddAccountAction',
        'params' =>['nickname' => 'char', 'users_group' => 'int', 'email' => 'varchar', 'password' => 'char']
    ],

    'EditAccount' => [
        'path' => '/p5/admin/edit-account/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\EditAccountAction',
        'params' =>['id' => '(\d+)', 'nickname' => 'char', 'users_group' => 'var', 'email' => 'varchar', 'password' => 'char']
    ],

    'deleteAccount' => [
        'path' => '/p5/delete-account/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\DeleteAccountAction',
        'params' =>['id' => '(\d+)']
    ],

    'contactPage' => [
       'path' => '/p5/contact',
       'methods' => ['GET'],
       'action' => 'contact'
    ],

    'logoutPage' => [
        'path' => '/p5/logout',
        'methods' => ['GET'],
        'action' => 'App\UI\Action\LogoutAction'
    ],

    'listPostsPage' => [
        'path' => '/p5/listPosts/',
        'methods' => ['GET', 'POST'],
        'action' => 'listPosts'
    ],

    'myAccount' => [
        'path' => '/p5/myAccount',
        'methods' => ['GET', 'POST'],
        'action' => 'myAccountPage'
    ],

    'addNewPost' => [
        'path' => '/p5/addPost',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\AddPostAction',
        'params' =>['titre' => 'char', 'content' => 'varchar']
    ],

    'registrationPage' =>[
        'path' => '/p5/registration',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\RegistrationAction',
        'params' =>['nickname' => 'char', 'email' => 'varchar', 'password' => 'char']
    ],


    'deletePost' => [
        'path' => '/p5/deletePost/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\DeletePostAction',
        'params' =>['id' => '(\d+)']
    ],

    'deleteComment' => [
        'path' => '/p5/deleteComment/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\DeleteCommentAction',
        'params' =>['id' => '(\d+)']
    ],

    'editPost' => [
        'path' => '/p5/editPost/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\EditPostAction',
        'params' =>['id' => '(\d+)', 'titre' => 'char', 'content' => 'varchar']
    ],

    'editComment' => [
        'path' => '/p5/editComment/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\EditCommentAction',
        'params' =>['id' => '(\d+)', 'content' => 'varchar']
    ],


    'login' => [
        'path' => '/p5/login',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\LoginAction',
        'params' =>['pseudo' => 'char', 'password' => 'char']
    ],

    'postDetails' => [
        'path' => '/p5/post/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\PostAction',
        'params' => ['id' => '(\d+)']
    ]
];
