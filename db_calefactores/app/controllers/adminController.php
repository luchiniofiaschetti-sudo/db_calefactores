<?php

require_once __DIR__ . '/../view/adminVista.php';

class AdminController {

    private $vista;

    public function __construct() {
        $this->vista = new adminVista();
    }

    public function panelAdmin($req) {
        $this->vista->setAdmin($req->admin);
        $this->vista->renderPanel();
    }
}