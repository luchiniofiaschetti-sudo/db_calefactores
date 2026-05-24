<?php

require_once __DIR__ . '/../view/loginVista.php';
require_once __DIR__ . '/../models/loginModel.php';

class LoginController {

    private $modelo;

    private $vistaLogin;
    public function __construct() {
        $this->modelo = new LoginModel();
        $this -> vistaLogin = new LoginVista();
    }

    public function formLogin($req) {
        $this -> vistaLogin->setAdmin($req->admin);
        $this -> vistaLogin->renderFormLogin();
    }

    public function confirmarlogin() {
        // corroborar la optencion de id.
        $admin = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

        $administrador = $this->modelo->getAdministrador($admin);

        if($administrador && password_verify($contraseña, $administrador->contraseña)) {
          
            $_SESSION['id'] = $administrador->id_usuario;
            $_SESSION['nombre'] = $administrador->nombre;
            $_SESSION['rol'] = $administrador->rol;

            header("Location: " . BASE_URL . "admin");
            exit;
        }else {
            header("location: " . BASE_URL . "login");
            exit;
        }
    }  
}