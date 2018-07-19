<form action="/p5/editComment/<?=$id?>" method="post">
    <p>
        <label>modifier le commentaire :</label><br>
        <textarea name="comment" rows="7" cols="50"><?=$content?></textarea><br />

        <input type="submit" value="modifier" />
    </p>
</form>