<?php
require_once __DIR__ . './../../etc/templateLoader.php';

$title = "Supprimer un compte" ?>

<?php ob_start();?>

<section>
    <?php if (!$showForm){
        ?>
        <p>Vous n'avez pas les droits nécessaires pour pouvoir supprimer ce compte</p>
        <?php
    } ?>
</section>

<?php $content = ob_get_clean();
require loadTemplate('template.php');
?>
