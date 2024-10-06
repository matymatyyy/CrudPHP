<?php

class Entradas{
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
            $entrada = $result->fetch_object();
            $stmt->close();
            return $entrada;
        }else{
            $stmt = $this->conn->prepare("SELECT N.id,N.titulo, N.descripcion, N.fecha, N.imagen, C.nombre FROM `$this->tabla` N INNER JOIN categorias C ON (N.id_categoria=C.id); ");
            $stmt->execute();
            $result = $stmt->get_result();
            $entradas = [];
            while ($entrada = $result->fetch_object()) {
                $entradas[] = $entrada;
            }
            $stmt->close();
            return $entradas;
        }
    }

    public function create($titulo,$descripcion,$texto,$id_cateogira,$id_user,$imagen){
        $stmt = $this->conn -> prepare("INSERT INTO `$this->tabla`(`titulo`, `descripcion`, `texto`, `id_categoria`, `id_user`, `imagen`) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("sssiis",$titulo,$descripcion,$texto,$id_cateogira,$id_user,$imagen);
        $stmt -> execute();
        $resultado = $stmt->affected_rows > 0;
        $stmt->close();
        return $resultado;
    }

    public function update($titulo,$descripcion,$texto,$id_categoira,$id_user,$imagen,$id){    #actualizar este funcion
        $stmt = $this->conn->prepare("UPDATE `$this->tabla` SET `titulo`=?,`descripcion`=?,`texto`=?,`id_categoria`=?,`id_user`=?,`imagen`=? WHERE id=? ;");
        $stmt->bind_param("sssiisi",$titulo,$descripcion,$texto,$id_categoira,$id_user,$imagen,$id);
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


}