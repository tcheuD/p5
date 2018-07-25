<?php
require_once __DIR__ . './../../config/templateLoader.php';

$title = "Acceuil" ?>

<?php ob_start();?>

<section>
    <?php
    while ($donnees = $post->fetch()){
    echo '<a href=/p5/post/'.$donnees['id'].'> auteur : '.$donnees['user_nickname'].", ".'identifiant :'.$donnees['id'].", ".'Titre : '.$donnees['title'].", ".'derniere modification : '.$donnees['modification_date']. "</a><br>";
    }
    ?>
</section>

<?php $content = ob_get_clean();
require loadTemplate('template.php');
?>
