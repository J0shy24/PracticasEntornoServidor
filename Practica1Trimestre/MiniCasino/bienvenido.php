<?php include("gestionCookie.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
</head>
<body>
    <h1>Bienvenido al Casino!</h1>

    <h4>Esto es su <?=$visita?>º visita</h4>
    <form action="<?=$_SERVER['PHP_SELF'];?>" method="get">
        <label>Introduzca el dinero con que va a jugar</label><input type="number" min="0" name="numIni">€
    </form>
</body>
</html>