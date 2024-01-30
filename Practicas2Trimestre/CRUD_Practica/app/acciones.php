<?php

function accionModificar($id) {
    $db = AcessoDatos::getModelo();
    $cliente = $db->getCliente($id);
    $orden = "Modificar";
    include_once "app/plantilla/formulario.php";
}

function accionDetalles($id) {
    $db = AcessoDatos::getModelo();
    $cliente = $db->getCliente($id);
    $orden = "Detalles";
    include_once "app/plantilla/formulario.php";
}

function accionBorrar($id) {
    $db = AcessoDatos::getModelo();
    $cliente = $db->borrarCliente($id);
}

function accionPostAlta() {
    $cliente = new Cliente();
    $cliente->first_name  = $_POST['nombre'];
    $cliente->last_name   = $_POST['apellidos'];
    $cliente->email   = $_POST['email'];
    $cliente->gender   = $_POST['genero'];
    $cliente->ip_address = $_POST['dir_ip'];
    $cliente->telefono = $_POST['telefono'];
    $db = AcessoDatos::getModelo();
    $db->crearCliente($cliente);
}

function accionPostModificar() {
    $cliente = new Cliente();
    $cliente->id = $_POST['id'];
    $cliente->first_name  = $_POST['nombre'];
    $cliente->last_name   = $_POST['apellidos'];
    $cliente->email   = $_POST['email'];
    $cliente->gender   = $_POST['genero'];
    $cliente->ip_address = $_POST['dir_ip'];
    $cliente->telefono = $_POST['telefono'];
    $db = AcessoDatos::getModelo();
    $db->modCliente($cliente);
}

function accionAlta() {
    $cliente = new Cliente();
    $cliente->first_name  = "";
    $cliente->last_name   = "";
    $cliente->email   = "";
    $cliente->gender   = "";
    $cliente->ip_address  = "";
    $cliente->telefono   = "";
    $orden= "Nuevo";
    include_once "plantilla/formulario.php";
}