<?php
require_once __DIR__ . './../../etc/templateLoader.php';

$title = "Ajouter un post" ?>

<?php ob_start();?>

<section>
    <?php if ($showForm) {
        ?>
        <form action="/p5/addPost" method="post">
            <p>
                <label>Titre</label><br>
                <input type="text" name="title" value="" /><br />

                <label>Contenu</label><br>
                <textarea name="content" rows="7" cols="50"></textarea><br />

                <button type="submit">Ajouter</button>
            </p>
        </form>
        <?php
    } else {
        ?>
        <p>Vous devez être connecté pour pouvoir ajouter un post</p>
        //TODO show login/registration
        <?php
    } ?>

</section>

<?php $content = ob_get_clean();
require loadTemplate('template.php');
?>
