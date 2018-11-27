<ul id="nav">

    <li><a href=/p5/>Acceuil</a></li>
    <li><a href=/p5/blog>Blog</a></li>

    <?php if (!isset($_SESSION['id'])) { ?>

    <li><a href=/p5/login>Connexion</a></li>
    <li><a href=/p5/registration>Inscription</a></li>

    <?php } else { ?>

        <li><a href=/p5/mon-compte/>Mon compte</a></li>
    <li><a href=/p5/logout>Déconnexion</a></li>
</ul>

    <?php } ?>

