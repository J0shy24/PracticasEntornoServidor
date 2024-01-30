<?php
//Iniciar session y set de cookie visita

session_start();
if(isset($_REQUEST['numIni'])){
    $_SESSION['dinero']=$_REQUEST['numIni'];
   
}

if(!isset($_SESSION['dinero'])){
    require_once('bienvenido.php');
}else {
    if(isset($_REQUEST['boton'])&&$_REQUEST['boton']=="abandonar"){
        require_once("terminado.php");
    }else{ 
        require_once('apuesto.php');
    }
}

?>