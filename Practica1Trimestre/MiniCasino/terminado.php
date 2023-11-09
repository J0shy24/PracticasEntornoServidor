<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Muchas gracias por jugar con nosotros.
        <br> Su resultado es de <?=$_SESSION['dinero'];?> Euros
    </h3>

    <button onclick="location.href='<?=$_SERVER['PHP_SELF'];?>'">Volver al Casino</button>
    <?php session_destroy();?>
</body>
</html>