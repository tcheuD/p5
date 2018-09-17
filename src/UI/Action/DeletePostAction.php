<?php

namespace App\UI\Action;

use App\Domain\Repository\PostRepository;
use App\UI\Action\Interfaces\DeletePostActionInterface;

require_once __DIR__ . './../../../etc/viewLoader.php';

class DeletePostAction implements DeletePostActionInterface
{
    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }


    public function __invoke($params, array $request = []) {


        $id = $params;

        $post = $this->postRepository->getPost($id);

            if (isset($_SESSION['id'])) {

                if (intval($_SESSION['id']) == $post->getUser()->getId()) {
                    $status = $this->postRepository->deletePost($id);
                    header("Location: /p5/");
                }
            }

        require loadView('DeletePostAction.php');
    }
}


