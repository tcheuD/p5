<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<form action="/p5/admin/edit-account/<?= $id ?>" method="post">
    <p>
        <label>Pseudo</label><br>
        <input type="text" name="nickname" value="<?= $userNickname ?>" /><br />

        Type d'utilisateur :<br />
        <input type="radio" name="users_group" value=1 <?= $usersGroupMember ?> id="user" /> <label for=1>Membre</label><br />
        <input type="radio" name="users_group" value=2 <?= $usersGroupAdmin ?>id="admin" /> <label for=2>Administrateur</label><br />

        <label>Mot de passe</label><br>
        <input type="password" name="password" value=""/><br />

        <label>Mot de passe (confirmation)</label><br>
        <input type="password" name="passwordConfirmation" value=""/><br />

        <label>Adresse email</label><br>
        <input type="email" name="email" value="<?= $userEmail ?>"/><br />

        <input type="submit" value="Modifier" />
    </p>
</form>
</body>
</html>
