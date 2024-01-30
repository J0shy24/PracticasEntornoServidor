<?php

class Cliente{
    private $telefono;
    private $nombre;
    private $puntos;

    public function __get($prop){
        if(property_exists($this,$prop){
            return $this->$prop;
        })
        return null;
    }

    public function __set($prop,$val){
        if(property_exists($this,$prop){
            $this->$prop=$val;
        })
    }

}