<?php
require_once __DIR__.'./../../etc/templateLoader.php';

$title = "Mes commentaires" ?>

<?php ob_start();?>

<section>
    <?php
    foreach ($comments as $comment) {

        echo '<p><a href="/p5/post/'.$comment->getPostId()->getId().'">'.$comment->getComment().'
              sujet : '.$comment->getPostId()->getTitle().'</a></p>';
    }
    ?>
</section>

<?php $content = ob_get_clean();
require loadTemplate('template.php');
?>
