<!DOCTYPE html>
<html>
<head>
    <title>Post details</title>
</head>
<body>
<?= $post ?>

<form action="/p5/post/<?=$id?>" method="post">
    <p>
        <label>Ecrire un commentaire :</label><br>
        <textarea name="comment" rows="7" cols="50"></textarea><br />

        <input type="submit" value="envoyer" />
    </p>
</form>
<?=$coms?>
</body>
</html>
