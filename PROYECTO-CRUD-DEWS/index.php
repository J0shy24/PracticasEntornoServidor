<?php
session_start();
define ('FPAG',10); // Número de filas por página


require_once 'app/helpers/util.php';
require_once 'app/config/configDB.php';
require_once 'app/models/Cliente.php';
require_once 'app/models/AccesoDatosPDO.php';
require_once 'app/controllers/crudclientes.php';

//---- PAGINACIÓN ----
$midb = AccesoDatos::getModelo();
$totalfilas = $midb->numClientes();
if ( $totalfilas % FPAG == 0){
    $posfin = $totalfilas - FPAG;
} else {
    $posfin = $totalfilas - $totalfilas % FPAG;
}

if ( !isset($_SESSION['posini']) ){
  $_SESSION['posini'] = 0;
}
$posAux = $_SESSION['posini'];
//------------

// Borro cualquier mensaje "
$_SESSION['msg']=" ";


//Control de Acceso MEJORA 8 y 9
if(!isset($_SESSION['acceso'])){
    $_SESSION['acceso']=false;
}

if(!isset($_SESSION['intentos'])){
    $_SESSION['intentos']=0;
}

if(!isset($_SESSION['rol'])){
    $_SESSION['rol']="";
}

if($_SESSION['acceso']==true&&$_SESSION['intentos']<3){

ob_start(); // La salida se guarda en el bufer
if ($_SERVER['REQUEST_METHOD'] == "GET" ){
    
    // Proceso las ordenes de navegación
    if ( isset($_GET['nav'])) {
        switch ( $_GET['nav']) {
            case "Primero"  : $posAux = 0; break;
            case "Siguiente": $posAux +=FPAG; if ($posAux > $posfin) $posAux=$posfin; break;
            case "Anterior" : $posAux -=FPAG; if ($posAux < 0) $posAux =0; break;
            case "Ultimo"   : $posAux = $posfin;
        }
        $_SESSION['posini'] = $posAux;
    }

    //MEJORA 1 Siguiente/Anterior
     // Proceso las ordenes de navegación en detalles
    if ( isset($_GET['nav-detalles']) && isset($_GET['id']) ) {
     switch ( $_GET['nav-detalles']) {
        case "Siguiente": crudDetallesSiguiente($_GET['id']); break;
        case "Anterior" : crudDetallesAnterior($_GET['id']); break;
        case "Imprimir" : ob_end_clean();crudDetallesImprimir($_GET['id']);break;
        
    }
     }

     //Proceso las ordenes de navegacion en Modificar
     if ( isset($_GET['nav-modificar']) && isset($_GET['id']) ) {
        switch ( $_GET['nav-modificar']) {
           case "Siguiente": crudModificarSiguiente($_GET['id']); break;
           case "Anterior" : crudModificarAnterior($_GET['id']); break;
           
       }
        }
     //MEJORA 2 ORDENAR
     if(!isset($_SESSION['orderedBy'])){
        $_SESSION['orderedBy']="id";
     }

     if(!isset($_SESSION['ordenAD'])){
        $_SESSION['ordenAD']="";
     }

    // Proceso de ordenes de CRUD clientes
    if ( isset($_GET['orden'])){
        switch ($_GET['orden']) {
            case "Nuevo"    : crudAlta(); break;
            case "Borrar"   : crudBorrar   ($_GET['id']); break;
            case "Modificar": crudModificar($_GET['id']); break;
            case "Detalles" : crudDetalles ($_GET['id']);break;
            case "Terminar" : crudTerminar(); break;
            case "Ordenar"  : 
                $_SESSION['orderedBy']=$_GET['valor'];
                if($_SESSION['ordenAD']=="ASC"){
                    $_SESSION['ordenAD']="DESC";
                }else{
                    $_SESSION['ordenAD']="ASC";
                }
                break;
            case "NuevoUsuario": nuevoUsuario(); break;
        }
    }
} 
// POST Formulario de alta o de modificación
else {
    if (  isset($_POST['orden'])){
         switch($_POST['orden']) {
             case "Nuevo"    : crudPostAlta(); break;
             case "Modificar": crudPostModificar(); break;
             case "NuevoUsuario":crudPostAltaUsuario(); break;
             case "Detalles":; // No hago nada
         }
    }
}

// Si no hay nada en la buffer 
// Cargo genero la vista con la lista por defecto
if ( ob_get_length() == 0){
    $db = AccesoDatos::getModelo();
    $posini = $_SESSION['posini'];
    $ordenCampo=$_SESSION['orderedBy'];
    $tipoOrden=$_SESSION['ordenAD'];
    $tvalores = $db->getClientes($posini,FPAG,$ordenCampo,$tipoOrden);

    if($_SESSION['rol']==1){
    require_once "app/views/list.php"; 

    }else{
        require_once "app/views/listRol0.php";
    }   
}

}else{
    
    require_once "app/views/login.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(!empty($_POST['usuario'])||!empty($_POST['contrasena'])){
            if(verificarUsuario($_POST['usuario'],$_POST['contrasena'])){
                $_SESSION['acceso']=true;
                $_SESSION['rol']=verificarRol($_POST['usuario']);
                header("Location: index.php");
            }else{
                $_SESSION['intentos']++;
            }
        }
    }

    if($_SESSION['intentos']>3){
        exit("Reinicia el Navegador");
    }
}

$contenido = ob_get_clean();
$msg = $_SESSION['msg'];
// Muestro la página principal con el contenido generado
require_once "app/views/principal.php";


