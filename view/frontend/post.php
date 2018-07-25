<?php
require_once __DIR__ . './../../config/templateLoader.php';

$title = htmlspecialchars($donnee['title']); ?>

<?php ob_start();

if ($showEditDelete) { ?>

<section>
    <a href=../editPost/<?= $id ?>>Modifier</a>
    <a href=../deletePost/<?= $id ?>>Supprimer</a>
    <?php
    }
    ?>

    <h1><?= $postTitle ?></h1>
    <p>auteur : <?= $userNickname ?></p>

    <article><?= $postContent ?></article>

    <form action="/p5/post/<?= $id ?>" method="post">
        <p>
            <label>Ecrire un commentaire :</label><br>
            <textarea name="comment" rows="7" cols="50"></textarea><br/>

            <input type="submit" value="envoyer"/>
        </p>
    </form>

    <?php
    while ($i = $coms->fetch()) {
        if ($i["u_user_id"] == intval($_SESSION["id"]) || checkUserGroup()) {
            echo '<a href=../editComment/' . $i["c_comment_id"] . '>Edit</a> <a href=../deleteComment/' . $i["c_comment_id"] . '>Delete</a> ';
        }
        echo 'user : ' . $i["user_nickname"] . ' message : ' . $i["comment"] . '<br />';

    }
    ?>


</section>

<?php $content = ob_get_clean();
require loadTemplate('template.php');
?>
