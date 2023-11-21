<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>MiniBank</title>
</head>
<body>
<?php 
$num= random_int(10, 1000)*401;
setcookie('token',$num);
if (isset($_GET['msg'])) echo "RESULTADO:". $_GET['msg']."<br>";
?>
<form action="ejercicio01.php" method="POST">
Importe de la operación: <input name="importe" type="number" focus><br>
<input type="submit" name="Orden" value="Ingreso">
<input type="submit" name="Orden" value="Reintegro">
<input type="submit" name="Orden" value="Ver saldo">
</form>
</body>
</html>
