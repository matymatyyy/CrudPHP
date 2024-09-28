<?php
class DataBase{
    public $conn;
    public $database;
    public $table;

    function __construct($database,$table){#cuando se incia la clase solo se dicta la tabla y la base datos
        $this->database= $database;
        $this->table= $table;     
    }

    function conectar(){
        $this->conn = new mysqli("localhost", "root", "", $this->database);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
}