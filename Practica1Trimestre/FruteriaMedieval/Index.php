<?php
session_start();

if(!isset($_SESSION['nombre'])){
    require_once('Bienvenido.php');
}else {
    require_once('Compra.php');
}

?>