<?php 

class LoginVista {

    protected $admin;

    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    public function renderFormLogin() {
        require_once __DIR__ . '/templates/formLogin.phtml';
    }
    public function confirmarLogout() {
        require_once __DIR__ . '/templates/confirmarLogout.phtml';
    }

}