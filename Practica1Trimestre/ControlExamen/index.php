<?php
session_start();
if(!isset($_SESSION['intentos'])){
$_SESSION['intentos']=5;
}

//Si llega a la maxima intentos no permite entrar
$intentos=$_SESSION['intentos'];
if($intentos<1){
  echo "<h1>HAS LLEGADO AL LIMITE DE INTENTOS
  <br> DEBERIAS REINICIAR TU NAVEGADOR O IR AL INCOGNITO!</h1> ";
  exit();
 }


include_once('app/funciones.php');

if (  !empty( $_GET['login']) && !empty($_GET['clave'])){
    if ( userOk($_GET['login'],$_GET['clave'])){
      if ( getUserRol($_GET['login']) == ROL_PROFESOR){
        $contenido = verNotaTodas($_GET['login']);
      } else {
        $contenido = verNotasAlumno($_GET['login']);
      }
      include_once ('app/resultado.php');
    } 
    // userOK falso
    else {
      $intentos=$_SESSION['intentos'];
      
      $_SESSION['intentos']--;
       $contenido = "El número de usuario y la contraseña no son válidos tienes $intentos Intentos";
       include_once('app/acceso.php');
    }
} else {
    $_SESSION['intentos']--;
    $contenido = " Introduzca su número de usuario y su contraseña <br>
    tienes $intentos Intentos";
    include_once('app/acceso.php');
}


