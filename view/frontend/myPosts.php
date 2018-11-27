<?php
require_once __DIR__.'./../../etc/templateLoader.php';

$title = "Mes articles" ?>

<?php ob_start();?>

<section>
    <?php
    foreach ($posts as $post) {

        echo '<p><a href="/p5/post/'.$post->getId().'">'.$post->getTitle().'</a></p>';
    }
    ?>
</section>

<?php $content = ob_get_clean();
require loadTemplate('template.php');
?>
