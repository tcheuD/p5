<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    <!--<link rel="stylesheet" href=/p5/public/css/style.css>-->
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
</head>
<body>

<header>
    <nav>
        <?php include "nav.php"?>
    </nav>
<h1><?=$title?></h1>

</header>

<div id='section_wrapper'>
    <section>
    <?=$content?>
    </section>
</div>

</body>
</html>
