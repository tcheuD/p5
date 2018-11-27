<?php
require_once __DIR__ . './../../etc/templateLoader.php';

$title = "Supprimer un compte" ?>

<?php ob_start();?>

<section>
    <?php if ($showForm){
        ?>

        <p>Toutes les informations du compte, y compris articles et commentaires seront définitivement supprimé</p>
        <form action="/p5/delete-account/<?= $id ?>" method="post">
            <p>
                <br />

                <label>Mot de passe (obligatoire)</label><br>
                <input type="password" name="password" value=""/><br />
                <input type="submit" value="Supprimer" />
            </p>
        </form>
        <?php
    } else { ?>
        <p>Vous n'avez pas les droits nécessaires pour pouvoir supprimer ce compte</p>
    <?php
    } ?>
</section>

<?php $content = ob_get_clean();
require loadTemplate('template.php');
?>
