<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<form action="/p5/registration" method="post">
    <p>
        <label>Pseudo</label><br>
        <input type="text" name="nickname" value="" /><br />

        <label>Mot de passe</label><br>
        <input type="password" name="password" value=""/><br />

        <label>Mot de passe (confirmation)</label><br>
        <input type="password" name="passwordConfirmation" value=""/><br />

        <label>Adresse email</label><br>
        <input type="email" name="email" value=""/><br />

        <input type="submit" value="Inscription" />
    </p>
</form>
<?php if(isset($alreadyExist)){
    if ($alreadyExist){ ?>
<p>nooooooooooooop</p>


<?php }} ?>
</body>
</html>
