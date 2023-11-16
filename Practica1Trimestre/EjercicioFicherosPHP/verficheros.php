<?php
//difinir fichero
define('FICHERO','ejemploeje2.txt');
$file=@fopen(FICHERO,"r");
$fcontent=file(FICHERO);

$linea=count($fcontent);
$numChar=0;
for($i=0;$i<$linea;$i++){
    $numChar+=strlen(trim($fcontent[$i]));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Numero de Caracteres del Fichero : <?=$numChar?></p>
    <p>Lineas del Fichero : <?=$linea?></p>
</body>
</html>