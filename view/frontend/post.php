<?php
require_once __DIR__ .'./../../etc/templateLoader.php';

$title = $post->getTitle(); ?>

<?php ob_start();

if (isset($_SESSION['id'])) {

    $authorId = intval($post->getUser()->getId());

if ($_SESSION['id'] == $authorId || $admin) {
?>

    <a href=../editPost/<?= $id ?>>Modifier</a>
    <a href=../deletePost/<?= $id ?>>Supprimer</a>
    <?php
    }
    }
    ?>
    <p>auteur : <?= $post->getUser()->getNickname(); ?></p>

    <article><?= $post->getContent(); ?></article>

    <form action="/p5/post/<?= $id ?>" method="post">
        <p>
            <label>Ecrire un commentaire :</label><br>
            <textarea name="comment" rows="3" cols="50"></textarea><br/>

            <input type="submit" value="envoyer"/>
        </p>
    </form>

    <?php
    foreach ($coms as $com) {

        if (isset($_SESSION['id']))
        {
            if($_SESSION['id'] == $com->getUser()->getId() || ($admin)){
                echo '<a href=../editComment/' . $com->getId()
                    . '>Edit</a> <a href=../deleteComment/' . $com->getId()
                    . '>Delete</a> ';
            }
        }

        echo '<p>' . $com->getUser()->getNickname();
        echo '  commentaire :' . $com->getComment() . '</p>';
    }
    ?>


<?php $content = ob_get_clean();
require loadTemplate('template.php');
?>
