<?php
require_once __DIR__ . './../../etc/templateLoader.php';

$title = "Modifier le commentaire" ?>

<?php ob_start();?>

<section>
    <?php if ($showForm) {
        ?>
        <form action="/p5/editComment/<?=$id?>" method="post">
            <p>
                <label>modifier le commentaire :</label><br>
                <textarea name="comment" rows="7" cols="50"><?=$content?></textarea><br />

                <input type="submit" value="modifier" />
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
