<?php
//cookie 
$visitas=0;
if(isset($_COOKIE['visitas'])){
    $visitas=$_COOKIE['visitas'];
}
$visitas++;
setcookie('visitas',$visitas,time()+(60*60*24*30*3));

$visitasNavegador=0;
$navegador=get_navegador();
//Fichero
define('FICHERO',"accesos.txt");
$file=@fopen(FICHERO,"a+") or die("Error con el fichero");

//Escribimos los datos en el fichero
fwrite($file,$navegador."|".$visitasNavegador++."\n");

//trabajamos con sus contenidos.
$fcontentArray=file(FICHERO);
$llaves=array();

array_walk($fcontentArray,function(&$v)use(&$llaves){
    $llaves[]=substr($v,0,strpos($v,"|"));
    $v=substr($v,strpos($v,"|")+1);
});
$fcontentArray=array_combine($llaves,$fcontentArray);
print_r($fcontentArray);
if(in_array($navegador,$fcontentArray)){
    
}else{
    fwrite($file,$navegador."|".$visitasNavegador++."\n");
}
echo "<br>";
echo "Visitas : ".$visitas;
echo "<br>";
echo "Visitas con ".substr($navegador,strrpos($navegador," ")). " durante los ultimos 3 meses : ";





//funciones ficheros
function get_navegador(){
    return $_SERVER['HTTP_USER_AGENT'];
}



?>
