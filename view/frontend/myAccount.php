<?php
require_once __DIR__.'./../../etc/templateLoader.php';

$title = "Mon compte" ?>

<?php ob_start(); ?>

<a href=/p5/edit-account/<?=$_SESSION['id']?>>Modifier mon compte</a>
<a href=/p5/mon-compte/articles><?=$postsNumber?> articles en ligne</a>
<a href=/p5/mon-compte/commentaires><?=$commentsNumber?> commentaires en ligne</a>
<a href=/p5/delete-account/<?=$_SESSION['id']?>>Supprimer mon compte</a>

<?php $content = ob_get_clean();
require loadTemplate('template.php');
?>
