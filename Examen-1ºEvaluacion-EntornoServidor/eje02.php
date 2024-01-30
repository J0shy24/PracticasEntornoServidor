<?php
define('FICHERO','contactos.txt');
session_start();
//Mensaje Global para que parezca al final
if(!isset($msj)){
    $msj="";
}

//Control CSRF (No funciona Ignoralo)
if(isset($_REQUEST['control'])){
    echo $_REQUEST['control'];
    $_SESSION['token']=$_REQUEST['control'];
}

if(isset($_SESSION['token'])){
    if($_SESSION['token']!=$_REQUEST['control']){
        $msj="ERROR DE TOKEN!";
        exit();
    }
}
//Un switch dependiendo del valor del submir
if(isset($_REQUEST['orden'])){
switch ($_REQUEST['orden']) {
    case 'Consultar':
        session_destroy();
        consultar();
        break;
    
    case 'Añadir':
        session_destroy();
        anadir();
        break;
}
}
//Funciones
//Se parte los datos del fichero por coma y por linea y devuelve un array associativo.
function infoFichero()
{
    $fichero = @fopen(FICHERO,'r') or die("ERROR al acceder al fichero");
    $nombre=[];
    $telefono=[];
    if(fgets($fichero)==""){
        return $nombre;
    }
    while ($linea = fgets($fichero)) {
        //Cambiamos la linea en un array separados por la coma
        //Se borra ambos lados por si acaso de espacio con el trim
        $datos = explode(',', trim($linea));
        array_push($nombre,$datos[0]);
        array_push($telefono,$datos[1]);
    }
    fclose($fichero);
   
    return  array_combine($nombre,$telefono);;
}

function anadir(){
    global $msj;
    $datosFichero=infoFichero();
    $encontrado=false;
    $name=$_REQUEST['nombre'];
    $numTel=$_REQUEST['telefono'];

    //Busca si existe el contacto
    foreach($datosFichero as $nombre => $telefono){
        if ($name==$nombre){
            $encontrado=true;
            break;
        }
    }


    if ($encontrado){
        $msj="Ya existe el contacto";
    }else{
        if(is_numeric($numTel)){
            $fichero = @fopen(FICHERO,'a+') or die("ERROR al acceder al fichero");
            $msj="Contacto anotado";
            fwrite($fichero,"$name,$numTel\n");
        }else{
            $msj="Formato de telefono no valido.";
        }
       
    }
   
    return $msj;
}

function consultar(){
    global $msj;
    $datosFichero=infoFichero();
    $encontrado=false;
    $name=$_REQUEST['nombre'];
    $numTel=0;

    foreach($datosFichero as $nombre => $telefono){
        if ($_REQUEST['nombre']==$nombre){
            $numTel=$telefono;
            $encontrado=true;
            break;
        }
    }

    if($encontrado){
        $msj="El numero de $name es $numTel";
    }else{
        $msj="No se encuentra $name en la agenda";
    }
    return $msj;
}
?>

<html>
<head>
<meta charset="UTF-8">
<title> Agenda App </title>
</head>
<body>


<form method="POST" >
<fieldset>
  <legend>Su agenda personal</legend>
    <input type="hidden" name="control" value="<?random_int(1,1000)?>">
    <label for="nombre">Nombre:</label><br>
    <input type='text' name='nombre' size=20 value ="Ramón">
    <input type='submit' name="orden" value="Consultar"><br>
    <label for="telefono">Teléfono:</label><br>
    <input type='tel' name='telefono' size=20 value ="9394848">
    <input type='submit' name="orden" value="Añadir">
</fieldset>
</form>
<p><?=$msj?></p>
</body>
</html>





