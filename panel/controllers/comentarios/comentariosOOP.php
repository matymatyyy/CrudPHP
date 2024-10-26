<?php
class Comentarios{
    private $conn;
    public $tabla;
    public function __construct(DataBase $db,$tabla) {
        $this->conn= $db->conectar();
        $this->tabla= $tabla;
    }
    #terminar este crud de comentarios
    public function read($id=""){

    }
    public function update(){

    }

    public function delete($id){

    }

    public function create(){
        
    }
}