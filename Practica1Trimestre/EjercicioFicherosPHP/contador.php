<?php
//definir fichero
define('FICHERO',"accesos.txt");
$visitas=0;
if(isset($_COOKIE['visitas'])){
    $visitas=$_COOKIE['visitas'];
}
$visitas++;
setcookie('visitas',$visitas,time()+(60*60*24*30*3));

//Abrir fichero
$file=@fopen(FICHERO,"r+") or die("Error en acceder el fichero");
$visitado=0;

if(file_exists(FICHERO)){
    $visitado=@file_get_contents(FICHERO);
}

$visitado++;
file_put_contents(FICHERO,$visitado);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Has accedido :<?=$visitado?>  veces en total</p>
    <p>Has accedido :<?=$visitas?>  veces en el navegador</p>
</body>
</html>