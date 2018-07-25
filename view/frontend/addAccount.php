<?php
require_once __DIR__ . './../../config/templateLoader.php';

$title = "Ajouter un compte" ?>

<?php ob_start();?>

<section>
    <?php if ($showForm) {
        ?>
        <form action="/p5/add-account" method="post">
            <p>
                <label>Pseudo</label><br>
                <input type="text" name="nickname" value="" /><br />

                Type d'utilisateur :<br />
                <input type="radio" name="users_group" value=1 id="user" /> <label for=1>Membre</label><br />
                <input type="radio" name="users_group" value=2 id="admin" /> <label for=2>Administrateur</label><br />

                <label>Mot de passe</label><br>
                <input type="password" name="password" value=""/><br />

                <label>Mot de passe (confirmation)</label><br>
                <input type="password" name="passwordConfirmation" value=""/><br />

                <label>Adresse email</label><br>
                <input type="email" name="email" value=""/><br />

                <input type="submit" value="Ajouter" />
            </p>
        </form>
        <?php
    } else {
        ?>
        <p>Vous n'avez pas l'autorisation d'acceder a cette page</p>

        <?php
    } ?>
</section>

<?php $content = ob_get_clean();
require loadTemplate('template.php');
?>
