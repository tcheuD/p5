<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\EditPostActionInterface;
use App\Domain\Repository\PostRepository;
use App\Domain\Repository\AccountRepository;
use App\Domain\Factory\PostFactory;

require_once __DIR__ . './../../../etc/viewLoader.php';
require_once __DIR__.'/Interfaces/EditPostActionInterface.php';

class EditPostAction implements EditPostActionInterface
{
    private $postRepository;
    private $accountRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
        $this->accountRepository = new AccountRepository();
    }

    public function __invoke($id, array $request = [])
    {
        $post = $this->postRepository->getPost($id);
        //var_dump($post->getUser()->getId());

        if (isset($_SESSION['id'])) {
            //$authorId = intval($post->getUser()->getId());
            if ($_SESSION['id'] == $post->getUser()->getId()) {
                $showForm = TRUE;
                if ($post->getTitle() !== null) {
                    $postTitle = htmlspecialchars($post->getTitle());
                } else $postTitle = "";

                if ($post->getContent() !== null) {
                    $postContent = htmlspecialchars($post->getContent());
                } else $postContent = "";


                if (isset($_POST["title"], $_POST["content"])) {
                    $prepare = PostFactory::edit($post, $_POST);
                    $status = $this->postRepository->editPost($prepare, $id);
                    header("Location: /p5/post/$id");

                }
            } else $showForm = false;
            require loadView('editPost.php');
        }
    }

    }
