<?php

class LoginModel extends Model{

    public function getAdministrador($admin) {
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE nombre = ?");
        $query->execute([$admin]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function crearUsuario($nombre, $email, $password, $rol = 'administrador') {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $query = $this->db->prepare("INSERT INTO usuarios (nombre, email, contraseña, rol) VALUES (?, ?, ?, ?)");
        return $query->execute([$nombre, $email, $hash, $rol]);
    }
}