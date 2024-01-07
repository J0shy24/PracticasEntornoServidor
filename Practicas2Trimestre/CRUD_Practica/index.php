<?php

session_start();

include_once("app/acessoDatos.php");

define('FPAG', 10);

$midb = AcessoDatos::getModelo();
$totalfilas = $midb->numClientes();
if ($totalfilas % FPAG == 0) {
    $posfin = $totalfilas - FPAG;
} else {
    $posfin = $totalfilas - $totalfilas % FPAG;
}

if (!isset($_SESSION['posini'])) {
    $_SESSION['posini'] = 0;
}
$posAux = $_SESSION['posini'];

if (isset($_GET['nav'])) {

    switch ($_GET['nav']) {
        case "<<":
            $posAux = 0;
            break;
        case ">":
            $posAux += FPAG;
            if ($posAux > $posfin) $posAux = $posfin;
            break;
        case "<":
            $posAux -= FPAG;
            if ($posAux < 0) $posAux = 0;
            break;
        case ">>":
            $posAux = $posfin;
    }
}
$_SESSION['posini'] = $posAux;

// Accedo al Modelo
$tvalores = $midb->getClientes($posAux, FPAG);

// Muestro la página principal
include_once "app/plantilla/principal.php";