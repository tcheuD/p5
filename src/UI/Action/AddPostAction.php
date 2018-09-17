<?php

namespace App\UI\Action;
use App\UI\Action\Interfaces\AddPostActionInterface;
use App\Domain\Repository\PostRepository;
use App\Domain\Model\Post;
use App\Domain\Factory\PostFactory;
require_once __DIR__.'./../../../etc/viewLoader.php';

class AddPostAction implements AddPostActionInterface
{
    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    public function __invoke(array $request = [])
    {
        //TODO link to a function to prevent flood for addPost & addComment
        if (isset($_SESSION['id'])) {
            $showForm = true;

            if (isset($_POST["title"]) && isset($_POST["content"])) {

                $post = PostFactory::add($_POST);
                $status = $this->postRepository->addPost($post);
                header("Location: post/$status");
                exit;
            }
        } else $showForm = false;
        require loadView('AddPost.php');
    }
}
