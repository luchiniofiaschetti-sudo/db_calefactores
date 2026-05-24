<?php

class adminVista {

    protected $admin;

    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    public function renderPanel() {
        require_once __DIR__ . '/templates/panelAdmin.phtml';
    }
}