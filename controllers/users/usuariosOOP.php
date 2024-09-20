<?php
include_once("../../include/connOOP.php"); #incluyo el objeto de la base de datos
class Usuarios{
    private $conn;
    public $tabla;
    
    public function __construct(DataBase $db) {#asignacion de la base de datos cuando se inicia el objeto
        $this->conn= $db->conectar();
        $this->tabla= $db->table;
    }

    public function create($user,$pass){
        $stmt = $this->conn -> prepare("INSERT INTO `$this->tabla`( `gmail`, `password`) VALUES (?,?)");
        $stmt->bind_param("ss",$user,$pass);
        $stmt -> execute();
        if($stmt -> affected_rows > 0){
            $stmt->close();
            return true;
        }else{
            $stmt->close();
            return false;
        }
    }

    public function read($id=""){
        if (!empty($id)) {
            $stmt = $this->conn->prepare("SELECT * FROM $this->tabla WHERE id=?");
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $result = $stmt->get_result();
            $usuarios = $result->fetch_object();
            $stmt->close();
            return $usuarios;
        }else{
            $stmt = $this->conn->prepare("SELECT * FROM $this->tabla ");
            $stmt->execute();
            $result = $stmt->get_result();
            $usuarios = [];
            while ($usuario = $result->fetch_object()) {
                $usuarios[] = $usuario;
            }
            $stmt->close();
            return $usuarios;
        }
    }

    public function update($gmail,$password,$id){    
        $stmt = $this->conn->prepare("UPDATE $this->tabla SET gmail = ? , password = ? WHERE id = ? ");
        $stmt->bind_param("ssi", $gmail,$password,$id);
        $stmt->execute();
        if ($stmt -> affected_rows > 0) {#si los datos que cambia son iguales no los detecta
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    public function detele($id) {
        $stmt = $this->conn->prepare("DELETE FROM $this->tabla WHERE id = ?"); #liminado fisico
        $stmt->bind_param("i", $id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    public function existe($user,$pass){
        $stmt = $this->conn -> prepare("SELECT * FROM $this->tabla WHERE gmail= ? AND password=? AND eliminado=0"); #funcion login
        $stmt->bind_param("ss",$user,$pass);
        $stmt -> execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function estado($id){
        $usuario=$this->read($id);
        $estado= $usuario->eliminado == 0 ? 1 : 0; #cambio de estado a traves de un ternario
        $stmt = $this->conn->prepare("UPDATE $this->tabla SET eliminado=$estado WHERE id = ? "); #eliminacion logica
        $stmt->bind_param("i",$id);
        $stmt->execute();
        if ($stmt -> affected_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
}