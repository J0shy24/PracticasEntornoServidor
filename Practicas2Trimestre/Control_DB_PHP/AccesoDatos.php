<?php

include 'Cliente.php';
include 'Pedido.php';

class AccesoDatos
{

    private static $modelo;
    private $dbh;
    private $c1;
    private $c2;
    private $c3;


    public static function getModelo()
    {
        if (!isset(self::$modelo)) {
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }

    private function __construct()
    {
        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=etienda;charset=utf8', 'root', '');
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }

        //Creo los objetos PDOStatement para las consultas
        $this->c1 = $this->dbh->prepare("SELECT * FROM Clientes WHERE nombre = :nombre AND clave = :clave");
        $this->c2 = $this->dbh->prepare("SELECT * FROM Pedidos WHERE cod_cliente = :cod_cliente");
        $this->c3 = $this->dbh->prepare("UPDATE Clientes SET veces = veces + 1 WHERE cod_cliente = :cod_cliente");
    }

    public function closeModelo()
    {
        if (self::$modelo != null) {
            $this->dbh = null;
            $this->c1 = null;
            $this->c2 = null;
            $this->c3 = null;
        }
    }

    public function getCliente($nombre, $clave)
    {

        $obj = null;

        $this->c1->bindParam(':nombre', $nombre);
        $this->c1->bindParam(':clave', $clave);
        $this->c1->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        $this->c1->execute();

        if ($obj = $this->c1->fetch()) {
            return $obj;
        }

        return null;
    }

    public function getPedidos($cod_cliente)
    {

        $pedidos = [];

        $this->c2->bindParam(':cod_cliente', $cod_cliente);
        $this->c2->setFetchMode(PDO::FETCH_CLASS, 'Pedido');
        if ($this->c2->execute()) {
            while ($obj = $this->c2->fetch()) {
                $pedidos[] = $obj;
            }
        }
        return $pedidos;
    }

    public function setCliente($cod_cliente)
    {

        $this->c3->bindParam(':cod_cliente', $cod_cliente);
        $this->c3->execute();
    }

    public function __clone()
    {
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }
}