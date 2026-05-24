<?php

require_once __DIR__ . '/model.php';

class AdminCalefactorModel extends Model {
    
    public function listarCalefactores() {
        $query = $this->db->prepare("SELECT * FROM calefactores");
        $query->execute();
        $calefactores = $query -> fetchAll(PDO::FETCH_OBJ);
        return $calefactores;
    }
   
    public function agregarCalefactor($nombre, $tipo, $potencia, $peso, $precio, $stock, $id_modelo){
        $query = $this->db->prepare("INSERT INTO calefactores (nombre, tipo, potencia, peso, precio, stock, id_modelo) VALUES (?,?,?,?,?,?,?)");
        $query ->execute([$nombre, $tipo, $potencia, $peso, $precio, $stock, $id_modelo]);
        return $this->db->lastInsertId();
    }
  
    public function eliminarCalefactor($id){
        $query = $this->db->prepare("DELETE FROM calefactores WHERE id_calefactor = ?");
        return $query ->execute([$id]);
    }
  
    public function editarCalefactor($nombre, $tipo, $potencia, $peso, $precio, $stock, $id){
        $query = $this->db->prepare("UPDATE calefactores SET nombre = ?, tipo = ?, potencia = ?, peso = ?, precio = ?, stock = ? WHERE id_calefactor = ?");
        return $query ->execute([$nombre, $tipo, $potencia, $peso, $precio, $stock, $id]);
    }
  
    public function getCalefactorId($id){
        $query = $this->db->prepare("SELECT * FROM calefactores WHERE id_calefactor = ?");
        $query ->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    public function getCalefactoresPorModelo($id) {
        $query = $this->db->prepare("SELECT * FROM calefactores WHERE id_modelo = ?");
        $query->execute([$id]);
        $calefactores = $query->fetchAll(PDO::FETCH_OBJ);
        return $calefactores;
    }
}