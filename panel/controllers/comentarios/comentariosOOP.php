<?php
class Comentarios{
    private $conn;
    public $tabla;
    public function __construct(DataBase $db,$tabla) {
        $this->conn= $db->conectar();
        $this->tabla= $tabla;
    }
    public function read($id=""){
        if (!empty($id)) {
            $stmt = $this->conn->prepare("SELECT * FROM $this->tabla WHERE id=?");
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_object();
            $stmt->close();
            return $result;
        }else{
            $stmt = $this->conn->prepare("SELECT c.id,c.comentario,c.fecha,n.titulo,u.name FROM $this->tabla c INNER JOIN noticias n ON (c.id_noticia=n.id) INNER JOIN user u ON (c.id_usuario=u.id);");
            $stmt->execute();
            $result = $stmt->get_result();
            $comtarios = [];
            while ($comentario = $result->fetch_object()) {
                $comtarios[] = $comentario;
            }
            $stmt->close();
            return $comtarios;
        }
    }
    public function update($comentario, $id){
        $stmt = $this->conn->prepare("UPDATE $this->tabla SET comentario = ? WHERE id = ? ");
        $stmt->bind_param("si", $comentario,$id);
        $stmt->execute();
        $resultado = $stmt->affected_rows > 0;
        $stmt->close();
        return $resultado;
    }

    public function delete($id){
        $stmt = $this->conn->prepare("DELETE FROM $this->tabla WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->affected_rows > 0;
        $stmt->close();
        return $resultado;
    }

    public function create($id_noticia,$id_usuario,$comentario){
        $stmt = $this->conn -> prepare("INSERT INTO `$this->tabla` (`id_noticia`, `id_usuario`, `comentario`) VALUES ( ? , ? , ? );");
        $stmt->bind_param("iis",$id_noticia,$id_usuario, $comentario);
        $stmt -> execute();
        $resultado = $stmt->affected_rows > 0;
        $stmt->close();
        return $resultado;
    }
    public function deleteComentario($id,$user){
        $stmt = $this->conn->prepare("DELETE FROM $this->tabla WHERE id = ? AND id_usuario = ? ");
        $stmt->bind_param("ii", $id,$user);
        $stmt->execute();
        $resultado = $stmt->affected_rows > 0;
        $stmt->close();
        return $resultado;
    }
}