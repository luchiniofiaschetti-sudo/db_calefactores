<?php 

require_once __DIR__ . '/model.php';

class AdminModeloModel extends Model {
  
    public function listaModelos() {
        $query = $this->db->prepare("SELECT * FROM modelos");
        $query->execute();
        $listado = $query->fetchAll(PDO::FETCH_OBJ);
        return $listado;
    }

    public function agregarModelo($nombre, $descripcion, $categoria, $imagen) {
        $query = $this->db->prepare("INSERT INTO modelos(nombre, descripcion, categoria, imagen) VALUES (?, ?, ?, ?)");
            if ($query->execute([$nombre, $descripcion, $categoria, $imagen])) {
                return $this->db->lastInsertId();
            }else{
                return false;
            }
        
    }

    public function eliminarModelo($id) {
        $query = $this->db->prepare("DELETE FROM modelos WHERE id_modelo = ?");
        return $query->execute([$id]);
    }

    public function editarModelo($id, $nombre, $descripcion, $categoria) {
        $query = $this->db->prepare("UPDATE modelos SET nombre = ?, descripcion = ?, categoria = ? WHERE id_modelo = ?");
        return $query->execute([$nombre, $descripcion, $categoria, $id]);
    }

    public function getModeloId($id) {
        $query = $this->db->prepare("SELECT * FROM modelos WHERE id_modelo = ?");
        $query->execute([$id]);
        $modelo = $query->fetch(PDO::FETCH_OBJ);
        return $modelo;
    }
    public function getModeloById($id) {
        $query = $this->db->prepare("SELECT * FROM modelos WHERE id_modelo = ?");
        $query->execute([$id]);
        $modelo = $query->fetch(PDO::FETCH_OBJ);
        return $modelo;
    }
}