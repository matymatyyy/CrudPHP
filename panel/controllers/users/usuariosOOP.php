<?php
class Usuarios{
    private $conn;
    public $tabla;
    
    public function __construct(DataBase $db,$tabla) {#asignacion de la base de datos cuando se inicia el objeto
        $this->conn= $db->conectar();
        $this->tabla= $tabla;
    }

    public function create($user,$name,$pass){
        $stmt = $this->conn -> prepare("INSERT INTO `$this->tabla`( `gmail`,`name`,`password`) VALUES (?,?,?)");
        $stmt->bind_param("sss",$user,$name, $pass);
        $stmt -> execute();
        $resultado = $stmt->affected_rows > 0;
        $stmt->close();
        return $resultado;
    }

    public function newUser($user,$name,$pass,$token,$estado=1){
        $stmt = $this->conn->prepare("INSERT INTO `$this->tabla`( `gmail`, `name`, `password`, `hash`, `eliminado`) VALUES (?,?,?,?,?)");
        $stmt->bind_param("ssssi", $user, $name, $pass, $token, $estado);
        $stmt -> execute();
        $resultado = $stmt->affected_rows > 0;
        $stmt->close();
        return $resultado;
    }

    public function confirmar($hash){
        $stmt = $this->conn->prepare("UPDATE $this->tabla SET eliminado=0 WHERE hash = ? ");
        $stmt->bind_param("s",$hash);
        $stmt->execute();
        $resultado = $stmt->affected_rows > 0;
        $stmt->close();
        return $resultado;
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

    public function update($gmail,$name,$password,$id){    
        $stmt = $this->conn->prepare("UPDATE $this->tabla SET gmail = ? , name = ? , password = ? WHERE id = ? ");
        $stmt->bind_param("sssi", $gmail,$name,$password,$id);
        $stmt->execute();
        $resultado = $stmt->affected_rows > 0; #si los datos que cambia son iguales no los detecta
        $stmt->close();
        return $resultado;
    }

    public function detele($id) {
        $stmt = $this->conn->prepare("DELETE FROM $this->tabla WHERE id = ?"); #liminado fisico
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->affected_rows > 0;
        $stmt->close();
        return $resultado;
    }

    public function existe($user,$pass){
        $stmt = $this->conn -> prepare("SELECT * FROM $this->tabla WHERE gmail= ? AND password= ? AND eliminado=0"); #funcion login
        $stmt->bind_param("ss",$user,$pass);
        $stmt -> execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result; 
    }
    public function duplicado($user){
        $stmt = $this->conn -> prepare("SELECT * FROM $this->tabla WHERE gmail= ? "); 
        $stmt->bind_param("s",$user);
        $stmt -> execute();
        $result = $stmt->get_result()->num_rows > 0;
        $stmt->close();
        return $result; 
    }
    public function existeAdmin($user,$pass){
        $stmt = $this->conn -> prepare("SELECT * FROM $this->tabla WHERE gmail= ? AND password=?"); 
        $stmt->bind_param("ss",$user,$pass);
        $stmt -> execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result; 
    }

    public function estado($id){
        $usuario=$this->read($id);
        $estado= $usuario->eliminado == 0 ? 1 : 0; #cambio de estado a traves de un ternario
        $stmt = $this->conn->prepare("UPDATE $this->tabla SET eliminado=$estado WHERE id = ? "); #eliminacion logica
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $resultado = $stmt->affected_rows > 0;
        $stmt->close();
        return $resultado;
    }

    public function existeID($id){
        $stmt = $this->conn -> prepare("SELECT * FROM $this->tabla WHERE id=?"); 
        $stmt->bind_param("i",$id);
        $stmt -> execute();
        $result = $stmt->get_result() > 0;
        $stmt->close();
        return $result; 
    }
}