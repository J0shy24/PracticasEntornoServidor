

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruteria Bienvenido</title>
</head>
<body>
    <h1>Fruteria del Siglo XXI</h1>
    <h5>Bienvenido a NUESTRA FRUTERIA!</h5>
    <form method="get" action="<?=$_SERVER['PHP_SELF'];?>">
        <label for="nombreClienteId">Introduzca el nombre del cliente</label>
        <input type="text" id="nombreClienteId" name="name" pattern="[A-Z][a-z]{2,}">
    </form>
</body>
</html>