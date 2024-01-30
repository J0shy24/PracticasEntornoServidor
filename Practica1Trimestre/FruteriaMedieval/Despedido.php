<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruteria Despedido</title>
</head>
<body>
    <h1>La Frutería del siglo XXI</h1>

    <h4>Muchas Gracias <?=$_SESSION['nombre']?></h4>
    
    <?=$compraRealizada=require_once('Pcomprados.php');?>
    <br>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <button name="nuevo" value="nuevo-cliente" onclick="location.href='<?=$_SERVER['PHP_SELF'];?>">Nuevo Cliente</button>
    </form>

    <?php
    session_destroy();
    ?>
    

</body>
</html>