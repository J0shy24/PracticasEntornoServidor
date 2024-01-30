<?php

class Producto{
 private $producto_no;
 private $descripcion;
 private $precio_actual;
 private $stock_disponible;

 public function __get($prop){
    if(property_exists($this,$prop)){
        return $this->$prop;
    }
    return null;
 }

 public function __set($prop,$val){
    if(property_exists($this,$prop)){
        $this->$prop=$val;
    }
 }
}