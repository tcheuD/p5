<?php
require_once __DIR__ . './../../config/templateLoader.php';

$title = "Mon compte" ?>

<?php ob_start();?>

<section>
    <a href=../p5/edit-account/<?=$userId?>>Modifier mes informations</a>
    <br><br>
    <?=$posts?>
</section>

<?php $content = ob_get_clean();
require loadTemplate('template.php');
?>
