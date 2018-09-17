<?php
require_once __DIR__ . './../../etc/templateLoader.php';

$title = "Modifier le post" ?>

<?php ob_start();?>

<section>
    <?php if ($showForm) {
        ?>
        <form action="/p5/editPost/<?= $id ?>" method="post">
            <p>
                <label>Titre</label><br>
                <input type="text" name="title" value="<?= $postTitle ?>"/><br/>

                <label>Contenu</label><br>
                <textarea name="content" rows="7" cols="50"><?= $postContent ?></textarea><br/>

                <input type="submit" value="Modifier"/>
            </p>
        </form>
        <?php
    } else {
        ?>
        <p>Vous n'avez pas l'autorisation d'acceder a cette page</p>

        <?php
    } ?>
</section>

<?php $content = ob_get_clean();
require loadTemplate('template.php');
?>
