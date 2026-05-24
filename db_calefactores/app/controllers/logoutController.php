<?php

require_once __DIR__ . '/../view/loginVista.php';

class LogoutController {
    private $vista;
    public function __construct() {
        $this -> vista = new LoginVista();
    }
    public function confirmarLogout($req) {
        $this -> vista->setAdmin($req);
        $this -> vista->confirmarLogout();
    }
    
    public function destruirSesion() {    
        
        session_start();
        $_SESSION = [];  // vaciar datos
        session_destroy();
        setcookie(session_name(), '', time() - 3600, '/'); // limpiar cooki

        //evitar cache browsers
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");

        header("Location: " . BASE_URL . "inicio");
        exit;
    }
}