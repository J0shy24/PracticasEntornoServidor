<?php
class Cliente{

    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $gender;
    private $ip_address;
    private $telefono;

    public function __get($name)
    {

        if(property_exists($this,$name)){
        return $this -> $name;
        }
    }

    public function __set($name,$value)
    {

        if(property_exists($this,$name)){
            return $this -> $name;
        }
    }
}

