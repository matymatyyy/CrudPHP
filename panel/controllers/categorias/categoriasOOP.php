<?php
class Categorias{
    private $conn;
    public $tabla;
    public function __construct(DataBase $db) {#asignacion de la base de datos cuando se inicia el objeto
        $this->conn= $db->conectar();
        $this->tabla= $db->table;
    }

    public function read($id=""){
        if (!empty($id)) {
            $stmt = $this->conn->prepare("SELECT * FROM $this->tabla WHERE id=?");
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $result = $stmt->get_result();
            $categoria = $result->fetch_object();
            $stmt->close();
            return $categoria;
        }else{
            $stmt = $this->conn->prepare("SELECT * FROM $this->tabla ");
            $stmt->execute();
            $result = $stmt->get_result();
            $categorias = [];
            while ($categoria = $result->fetch_object()) {
                $categorias[] = $categoria;
            }
            $stmt->close();
            return $categorias;
        }
    }

    public function update($nombre,$id){    #actualizar este funcion
        $stmt = $this->conn->prepare("UPDATE $this->tabla SET nombre = ? WHERE id = ? ");
        $stmt->bind_param("si", $nombre,$id);
        $stmt->execute();
        $resultado = $stmt->affected_rows > 0; #si los datos que cambia son iguales no los detecta
        $stmt->close();
        return $resultado;
    }

    public function detele($id) {
        $stmt = $this->conn->prepare("DELETE FROM $this->tabla WHERE id = ?"); 
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->affected_rows > 0;
        $stmt->close();
        return $resultado;
    }

    public function create($nombre){
        $stmt = $this->conn -> prepare("INSERT INTO `$this->tabla` (`nombre`) VALUES ( ? )");
        $stmt->bind_param("s",$nombre);
        $stmt -> execute();
        $resultado = $stmt->affected_rows > 0;
        $stmt->close();
        return $resultado;
    }

}