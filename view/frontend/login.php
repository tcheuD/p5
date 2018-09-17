<?php
require_once __DIR__.'./../../etc/templateLoader.php';

$title = "Connexion" ?>

<?php ob_start();?>

<section>
    <form action="/p5/login" method="post">
        <p>
            <label>Pseudo</label><br>
            <input type="text" name="pseudo" value="" /><br />

            <label>Mot de passe</label><br>
            <input type="password" name="password" value=""/><br />

            <button type="submit">Log in</button>
        </p>
    </form>
</section>

<?php $content = ob_get_clean();
require loadTemplate('template.php');
?>
