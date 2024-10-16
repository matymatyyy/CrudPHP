<?php
class DataBase{
    private $conn;
    private $database;

    function __construct($database){#cuando se incia la clase solo se dicta la tabla y la base datos
        $this->database= $database;
    }

    function conectar(){
        $this->conn = new mysqli("localhost", "root", "", $this->database);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
        return $this->conn; #podriamos hacer geter y seter para mejorar los accesos
    }
}