<?php
class Pedido{
    private $num_pedido;
    private $cod_cliente;
    private $producto;
    private $precio;

    //metodos
    public function __get($prop){
        if(property_exists($this,$prop)){
            return $this->$prop;
        }
    }

    public function __set($prop,$val){
        if(property_exists($this,$prop)){
            $this->$prop=$val;
        }
    }
}