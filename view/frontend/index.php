<?php
require_once __DIR__.'./../../etc/templateLoader.php';

$title = "Acceuil" ?>

<?php ob_start();?>

<section>
    <?php
    foreach ($posts as $post) {

        echo $post->getTitle();

        if($post->getUser()->getNickname() == null)
        {
            $userNickname = "compte supprimé";
        } else $userNickname = $post->getUser()->getNickname();
        echo '<p>' .$post->getId();
        echo '<a href="/p5/post/'.$post->getId().'">'.$post->getTitle().'</a>';
        echo ' par :'.$userNickname.'    '.$post->getUser()->getId().'</p>';


    }
    ?>
</section>

<?php $content = ob_get_clean();
require loadTemplate('template.php');
?>
