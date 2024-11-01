<?php

class Entradas{
    private $conn;
    public $tabla;
    public function __construct(DataBase $db,$tabla) {#asignacion de la base de datos cuando se inicia el objeto
        $this->conn= $db->conectar();
        $this->tabla= $tabla;
    }

    public function read($id=""){
        if (!empty($id)) {
            $stmt = $this->conn->prepare("SELECT * FROM $this->tabla N INNER JOIN categorias C ON (N.id_categoria=C.id) WHERE N.id=? ;");
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $result = $stmt->get_result();
            $entrada = $result->fetch_object();
            $stmt->close();
            return $entrada;
        }else{
            $stmt = $this->conn->prepare("SELECT N.id,N.titulo, N.descripcion, N.fecha, N.imagen, C.nombre,A.gmail FROM $this->tabla N INNER JOIN categorias C ON (N.id_categoria=C.id) INNER JOIN admin A ON (N.id_user=A.id); ");
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

    public function filtro($cat){#terminar el filtro para el index
            $stmt = $this->conn->prepare("SELECT N.id,N.titulo, N.descripcion, N.fecha, N.imagen, C.nombre FROM `$this->tabla` N INNER JOIN categorias C ON (N.id_categoria=C.id) WHERE C.id=? ;");
            $stmt->bind_param("i",$cat);
            $stmt->execute();
            $result = $stmt->get_result();
            $entradas = [];
                while ($entrada = $result->fetch_object()) {
                $entradas[] = $entrada;
            }
            $stmt->close();
            return $entradas;
    }

    public function readAjax($inicio, $cantidad) {
        $stmt = $this->conn->prepare("SELECT N.id, N.titulo, N.descripcion, N.fecha, N.imagen, C.nombre FROM `$this->tabla` N INNER JOIN categorias C ON (N.id_categoria = C.id) ORDER BY N.fecha DESC LIMIT ?, ? ;");
        $stmt->bind_param("ii", $inicio, $cantidad);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC); #el MYSQLI_ASSOC lo devuelve como clave valor mas facil para trabajarlo con js
    }
    
    public function filtroAjax($cat, $inicio, $cantidad) { #readFiltro para AJAX
        $stmt = $this->conn->prepare("SELECT N.id, N.titulo, N.descripcion, N.fecha, N.imagen, C.nombre FROM `$this->tabla` N INNER JOIN categorias C ON (N.id_categoria = C.id) WHERE C.id = ? ORDER BY N.fecha DESC LIMIT ?, ? ;"); #siempre traemos las noticias mas nuevas primero
        $stmt->bind_param("iii", $cat, $inicio, $cantidad);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function filtroBusca($filtroCat = "", $filtroRed = "", $filtroTit = "") {
        $query = "SELECT N.id, N.titulo, N.descripcion, N.fecha, N.imagen, C.nombre, A.gmail FROM `$this->tabla` N INNER JOIN categorias C ON (N.id_categoria = C.id) INNER JOIN admin A ON (N.id_user = A.id) WHERE 1=1"; #falta ordenar por fecha y demas opciones
        $params = [];
        $types = ""; 
        if (!empty($filtroCat)) {
            $query .= " AND C.id = ?";
            $params[] = $filtroCat;
            $types .= "i";
        }
        if (!empty($filtroRed)) {
            $query .= " AND A.gmail = ?";
            $params[] = $filtroRed;
            $types .= "s";
        }
        if (!empty($filtroTit)) {
            $query .= " AND N.titulo LIKE ?";
            $params[] = "%$filtroTit%";
            $types .= "s"; 
        }
        $stmt = $this->conn->prepare($query);
        if ($params) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $entradas = [];
        while ($entrada = $result->fetch_object()) {
            $entradas[] = $entrada;
        }
        $stmt->close();
        return $entradas;
    }

    public function guardarComentario($id_noticia, $id_usuario, $comentario) {
        $stmt = $this->conn->prepare("INSERT INTO comentarios (id_noticia, id_usuario, comentario) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $id_noticia, $id_usuario, $comentario);
        $stmt->execute();
    }
    
    public function obtenerComentarios($id_noticia) {
        $stmt = $this->conn->prepare("
            SELECT c.id,c.comentario, c.fecha, u.name, c.id_usuario FROM comentarios c JOIN user u ON c.id_usuario = u.id WHERE c.id_noticia = ? ORDER BY c.fecha DESC ");
        $stmt->bind_param("i", $id_noticia);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
}