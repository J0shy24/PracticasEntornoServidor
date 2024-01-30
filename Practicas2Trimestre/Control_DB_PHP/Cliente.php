<?php
class Cliente{
    private $cod_cliente;
    private $nombre;
    private $clave;
    private $veces;

    //funciones getter y setter

    public function __get($prop)
    {
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