<?php
require_once "AccesoDatos.php";


if(empty($_REQUEST['nom_cliente'])||empty($_REQUEST['pass_cliente'])){
    $mensaje="Error de acesso";
    require_once("vistaerror.php");
    exit();
}

$nombre=$_REQUEST['nom_cliente'];
$clave=$_REQUEST['pass_cliente'];

$db =AccesoDatos::getModelo();
$client=$db->getCliente($nombre,$clave);

if($client==null){
    $mensaje="Cliente no existe";
    require_once("app/plantillas/vistaerror.php");
    exit();
}

$db->setCliente($client->cod_cliente);
$pedidos=$db->getPedidos($client->cod_cliente);


$db->closeModelo();

include "vistapedidos.php";

?>