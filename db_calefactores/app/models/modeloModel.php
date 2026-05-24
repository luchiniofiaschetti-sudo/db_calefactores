<?php

require_once __DIR__ . '/model.php';

class ModeloModel extends Model{

    public function getModelos() {
        $query = $this->db->prepare("SELECT * FROM modelos");
        $query->execute();
        $modelos = $query->fetchAll(PDO::FETCH_OBJ);
        return $modelos;
    }
    public function getModeloById($id) {
        $query = $this->db->prepare("SELECT * FROM modelos WHERE id_modelo = ?");
        $query->execute([$id]);
        $modelo = $query->fetch(PDO::FETCH_OBJ);
        return $modelo;
    }
}
