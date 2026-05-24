<?php

require_once __DIR__ . '/model.php';

class CalefactorModel extends Model{
    
    public function mostrarCalefactores() {
        $query = $this->db->prepare("SELECT * FROM calefactores");
        $query->execute();
        $lista =  $query->fetchAll(PDO::FETCH_OBJ);
        return $lista;
    }

    public function mostrarDetalle($id) {
        $query = $this->db->prepare("SELECT * FROM calefactores WHERE id_calefactor = ?");
        $query->execute([$id]);
        $detalle = $query->fetch(PDO::FETCH_OBJ);
        return $detalle;
    }

    public function getCalefactoresPorModelo($id) {
        $query = $this->db->prepare("SELECT * FROM calefactores WHERE id_modelo = ?");
        $query->execute([$id]);
        $calefactores = $query->fetchAll(PDO::FETCH_OBJ);
        return $calefactores;
    }
}