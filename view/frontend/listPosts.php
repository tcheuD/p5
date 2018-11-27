<?php
require_once __DIR__.'./../../etc/templateLoader.php';

$title = "Blog" ?>

<?php ob_start();?>

<section>
    <?php

    if ($session)
    { ?>
        <a href=/p5/addPost>Ajouter un article</a>
    <?php

    }

    foreach ($posts as $post) {

        if($post->getUser()->getNickname() == null) {

            $userNickname = "compte supprimé";

        } else $userNickname = $post->getUser()->getNickname();

        echo '<a href="/p5/post/'.$post->getId().'">'.$post->getTitle().'</a>';
        echo ' par :'.$userNickname.'    '.$post->getUser()->getId().'</p>';
    }
    ?>
</section>

<?php $content = ob_get_clean();
require loadTemplate('template.php');
?>
