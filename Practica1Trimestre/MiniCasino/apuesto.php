<?php
    require_once('funcionesJuego.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apuesto</title>
</head>
<body>
    <h3><?=$msjResultado;?><br></h3>
    <h3><?=$msjResultadoApuesta;?></h3>
    <h3>Dispone de <?=$_SESSION['dinero']?>€ para Apostar</h3>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label>Cantidad a apostar:</label><input type="number" min="0" name="dineroApostar">
        <br>
        <label>Tipo de Apuesta</label><input type="radio" name="juego" value="par">Par <input type="radio" name="juego" value="impar">Impar
        <br>
        <button type="submit" name='boton' value="apostar">Apostar cantidad</button><button type="submit" name='boton' value="abandonar">Abandonar Casino</button>
    </form>
</body>
</html>