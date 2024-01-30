<?php

class BiciElectrica{

    private $id;
    private $coordx;
    private $coordy;
    private $bateria;
    private $operativa;

    function __construct($id,$coordx,$coordy,$bateria,$operativa){
        $this->id=$id;
        $this->coordx=$coordx;
        $this->coordy=$coordy;
        $this->bateria=$bateria;
        $this->operativa=$operativa;
    }

    function __get($prop){
        if(property_exists($this,$prop)){
            return $this->$prop;
        }
    }

    function __set($prop,$val){
        if(property_exists($this,$prop)){
            $this->$prop=$val;
        }
    }

    function __toString(): string{
        return "id : ".$this->id."|| bateria :".$this->bateria; 
    }

    function distancia($x,$y){
        return round(sqrt(pow($this->coordx-$x,2)+pow($this->coordy-$y,2)));
    }
}