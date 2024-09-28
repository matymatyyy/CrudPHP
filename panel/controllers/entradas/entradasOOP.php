<?php

class Entradas{
    private $conn;
    public $tabla;
    public function __construct(DataBase $db) {#asignacion de la base de datos cuando se inicia el objeto
        $this->conn= $db->conectar();
        $this->tabla= $db->table;
    }
}