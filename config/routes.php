<?php

return [
    'homepage' => [
        'path' => '/',
        'methods' => ['GET'],
        'action' => 'App\UI\Action\HomeAction'
    ],

    'blog' => [
        'path' => '/blog',
        'methods' => ['GET'],
        'action' => 'App\UI\Action\ListPostsAction'
    ],

    'addAccount' => [
        'path' => '/add-account',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\AddAccountAction',
        'params' =>['nickname' => 'char', 'users_group' => 'int', 'email' => 'varchar', 'password' => 'char']
    ],

    'EditAccount' => [
        'path' => '/mon-compte/edit-account/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\EditAccountAction',
        'params' =>['id' => '(\d+)', 'nickname' => 'char', 'users_group' => 'var', 'email' => 'varchar', 'password' => 'char']
    ],

    'deleteAccount' => [
        'path' => '/delete-account/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\DeleteAccountAction',
        'params' =>['id' => '(\d+)']
    ],

    'contactPage' => [
       'path' => '/contact',
       'methods' => ['GET'],
       'action' => 'contact'
    ],

    'logoutPage' => [
        'path' => '/logout',
        'methods' => ['GET'],
        'action' => 'App\UI\Action\LogoutAction'
    ],

    'myAccount' => [
        'path' => '/mon-compte/',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\MyAccountAction'
    ],

    'addNewPost' => [
        'path' => '/blog/addPost',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\AddPostAction',
        'params' =>['titre' => 'char', 'content' => 'varchar']
    ],

    'registrationPage' =>[
        'path' => '/registration',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\RegistrationAction',
        'params' =>['nickname' => 'char', 'email' => 'varchar', 'password' => 'char']
    ],

    'deletePost' => [
        'path' => '/blog/deletePost/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\DeletePostAction',
        'params' =>['id' => '(\d+)']
    ],

    'deleteComment' => [
        'path' => '/blog/deleteComment/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\DeleteCommentAction',
        'params' =>['id' => '(\d+)']
    ],

    'editPost' => [
        'path' => '/blog/editPost/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\EditPostAction',
        'params' =>['id' => '(\d+)', 'titre' => 'char', 'content' => 'varchar']
    ],

    'editComment' => [
        'path' => '/p5/blog/editComment/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\EditCommentAction',
        'params' =>['id' => '(\d+)', 'content' => 'varchar']
    ],


    'login' => [
        'path' => '/login',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\LoginAction',
        'params' =>['pseudo' => 'char', 'password' => 'char']
    ],

    'postDetails' => [
        'path' => '/blog/post/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\PostAction',
        'params' => ['id' => '(\d+)']
    ],

    'MyPosts' => [
         'path' => '/mon-compte/articles',
         'methods' => ['GET', 'POST'],
         'action' => 'App\UI\Action\MyPosts',
    ],

    'MyComments' => [
    'path' => '/mon-compte/commentaires',
    'methods' => ['GET', 'POST'],
    'action' => 'App\UI\Action\MyComments',
    ],

    'ForgotPassword' => [
        'path'=> '/login/forgot-password',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\ForgotPassword',
    ],

    'ResetPassword' => [
        'path'=> '/login/reset-password/{pass}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\ResetPassword',
        'params' => ['pass' => '(\w+)']
    ]
];
