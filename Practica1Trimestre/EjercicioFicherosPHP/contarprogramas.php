<?php
define('DIRECTORIO','.');

$directory=@opendir(DIRECTORIO) or die("Error");
//Scandir nos devuelve un array de los contenidos del directorio.
$directorycontent=scandir(DIRECTORIO);
print_r($directorycontent);
echo "<br>";
echo "<br>";
//array_values nos devuelve un array que empieza por [0], array_filter filtra el array original con el callback pero nos devuelve los 
//indices originales.
$directorycontent=array_values(array_filter($directorycontent,'phpExt'));
print_r($directorycontent);
echo "<br>";
echo "<br>";
echo "<br>";
//recorremos el array del contenido del directorio
$numeroLineaDirectorio=0;//Lineas en el directorio
foreach($directorycontent as $file){
    $filePath=DIRECTORIO."/".$file;
    $numeroLineaFichero=contarLineas($filePath);
    $numeroLineaDirectorio+=$numeroLineaFichero;
    echo basename($filePath)." | ".$numeroLineaFichero. " Lineas <br>";
}
   echo "<br>El directorio contiene : ".$numeroLineaDirectorio." Lineas"; 

//funciones
function phpExt($val){
    return (substr($val,strlen($val)-3,3)=="php");
}

function contarLineas($val){
    $fichero=@fopen($val,'r+') or die("Error fichero");
    return count(file($val));
}
?>