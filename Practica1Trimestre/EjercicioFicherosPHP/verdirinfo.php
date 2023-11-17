<?php
define('DIRECTORIO','./direjemplo');

if(!is_dir(DIRECTORIO)){
    die("NO EXISTE EL DIRECTORIO!");
}

$directory=@opendir(DIRECTORIO) or die("ERROR ACCEDER AL DIRECTORIO");
//Devuelve un array 
$directoryContent=scandir(DIRECTORIO);
//Creamos un array que tendrá el tipo y el tamaño.
$val=array();

foreach($directoryContent as $fichero){
    $filepath=DIRECTORIO."/".$fichero;
    $tipo=mime_content_type($filepath);
    $tamano=filesize($filepath);
    array_push($val,[$tipo,$tamano]);
    
}
//COMBINAMOS EL ARRAY del contenido del directorio y el nuevo array con tipo y tamaño
// Output seria como "nombreFichero"=>[tipo,tamaño].
$directoryContent=array_combine($directoryContent,$val);

echo "CONTENIDOS DEL DIRECTORIO<br><br>";
foreach($directoryContent as $key => $value){
    echo $key . " | ". $value[0] . " | ". $value[1];
    echo "<br>";
}
echo "<br>";
echo "<br>";

usort($directoryContent,'sortTamaño');
echo "FICHEROS DEL DIRECTORIO ORDENADO POR TAMAÑO <br><br> ";
foreach($directoryContent as $key => $value){
    //SOLO ENSEÑAMOS LOS FICHEROS
    if($value[0]!=="directory"){
    echo $key . " | ". $value[0] . " | ". $value[1];
    echo "<br>";
    }
}
//FUNCION DE TAMAÑO MENOR A MAYOR | CAMBIA el '-' a '+' si quieres que sea MAYOR A MENOR
function sortTamaño($x,$y){
    return $x[1]-$y[1];
}

//Mientras haya contenido seguirá leyendo el directorio.
/*
$directoryContent=readdir($directory);

while($directoryContent!==false){
$filePath=DIRECTORIO."/".$directoryContent;

        if(is_file($filePath)){
            $tamano=filesize($filePath);
            $type=filetype($filePath);
            echo basename($filePath)." | ";
            echo $type." | ";
            echo $tamano. " bytes";
            echo "<br>";
        }

    $directoryContent=readdir($directory);
}
*/

?>