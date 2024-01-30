<?php
session_start();
if(!isset($_SESSION['posini'])){
    $_SESSION['posini']=0;
}
require_once "app/Cliente.php";
require_once "app/AccesoDAO.php";
define('FPAG',10);

$primero=$_SESSION['posini'];
if(isset($_GET["orden"])){
    switch ($_GET["orden"]){
        case "Primero": $primero=0;break;
        case "Siguiente":$primero+=FPAG;
                        if($primero>$total)$primero=$total; break;
        case "Anterior":$primero-=FPAG; 
                        if($primero<0)$primero=0; break;
        case "Ultimo":$primero=$total-FPAG; break;

    }
}

$db = AccesoDAO::getModelo();
$primero=1;
$cuantos=30;
$db->getClientes($primero,$cuantos);

echo "Todo bien";