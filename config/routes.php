<?php

return [
    'homepage' => [
        'path' => '/p5/',
        'methods' => ['GET'],
        'action' => 'App\UI\Action\HomeAction'
    ],

    'blog' => [
        'path' => '/p5/blog',
        'methods' => ['GET'],
        'action' => 'App\UI\Action\ListPostsAction'
    ],

    'addAccount' => [
        'path' => '/p5/add-account',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\AddAccountAction',
        'params' =>['nickname' => 'char', 'users_group' => 'int', 'email' => 'varchar', 'password' => 'char']
    ],

    'EditAccount' => [
        'path' => '/p5/edit-account/{id}',
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

    'myAccount' => [
        'path' => '/p5/mon-compte/',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\MyAccountAction'
    ],

    'addNewPost' => [
        'path' => '/p5/blog/addPost',
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
        'path' => '/p5/blog/deletePost/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\DeletePostAction',
        'params' =>['id' => '(\d+)']
    ],

    'deleteComment' => [
        'path' => '/p5/blog/deleteComment/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\DeleteCommentAction',
        'params' =>['id' => '(\d+)']
    ],

    'editPost' => [
        'path' => '/p5/blog/editPost/{id}',
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
        'path' => '/p5/login',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\LoginAction',
        'params' =>['pseudo' => 'char', 'password' => 'char']
    ],

    'postDetails' => [
        'path' => '/p5/blog/post/{id}',
        'methods' => ['GET', 'POST'],
        'action' => 'App\UI\Action\PostAction',
        'params' => ['id' => '(\d+)']
    ],

    'MyPosts' => [
         'path' => '/p5/mon-compte/articles',
         'methods' => ['GET', 'POST'],
         'action' => 'App\UI\Action\MyPosts',
    ],

    'MyComments' => [
    'path' => '/p5/mon-compte/commentaires',
    'methods' => ['GET', 'POST'],
    'action' => 'App\UI\Action\MyComments',
    ]

];
