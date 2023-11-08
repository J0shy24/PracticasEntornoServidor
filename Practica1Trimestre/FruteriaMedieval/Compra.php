
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>FRUTERIA Compra</title>
</head>
<body>
<H1> La Frutería del siglo XXI</H1>

<?=$compraRealizada=require_once('Pcomprados.php');?>
<B>BIENVENIDO <?=$_SESSION['nombre'];?> HAZ TU COMPRA</B><br>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <label>Fruta :</label><select name="fruta">
        <option value="naranja">Naranja</option>
        <option value="platano">Platano</option>
        <option value="mango">Mango</option>
        <option value="kaki">Kaki</option>
    </select>
    <label> Cantidad :</label>
    <input type="number" value="0" size="4" min="0" name="cantidad">
    <button value="añadir" name="button" type="submit">Añadir</button>
    <button value="terminar" name="button" type="submit">Terminar</button>
</form>
</body>
</html>