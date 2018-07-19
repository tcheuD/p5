<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<?php if ($showForm) {
    ?>
    <form action="/p5/editPost/<?= $id ?>" method="post">
        <p>
            <label>Titre</label><br>
            <input type="text" name="title" value="<?= $postTitle ?>"/><br/>

            <label>Contenu</label><br>
            <textarea name="content" rows="7" cols="50"><?= $postContent ?></textarea><br/>

            <input type="submit" value="Commenter"/>
        </p>
    </form>
    <?php
} else {
?>
    <p>Vous n'avez pas l'autorisation d'acceder a cette page</p>

<?php
} ?>
</body>
</html>
