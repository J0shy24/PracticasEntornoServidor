<?php
$nombres = ["Juan","Pedro","María","Elena","Luis"];
$notas  = [7.5, 6.0, 7.8, 9.5, 3.5 ];

// Une los array en uno nuevo
$calificaciones = unir ($nombres, $notas);

// Creo un nuevo array
$datos = separar($calificaciones);
echo "<code><pre>";
 echo "<h2> Tabla de Calificaciones :</h2> <br> ";
print_r($calificaciones);
echo "<br>";
echo "<h2>Tabla de Datos : </h2><br> ";
print_r($datos);
echo "</pre></code>";

//funciones
function unir($arrayLLaves,$arrayValores){
    return array_combine($arrayLLaves,$arrayValores);
}

function separar($array){
    $nombre=[];
    $notas=[];

    foreach($array as $llave => $valor){
        array_push($nombre,$llave);
        array_push($notas,$valor);
    }

    return [$nombre,$notas];
}
?>