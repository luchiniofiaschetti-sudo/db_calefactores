<?php

class ModeloVista {

    protected $admin;

    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    public function confirmarEliminacionModelo($model) {
        require_once __DIR__ . '/templates/modeloTemplate/confirmarEliminacionModelo.phtml';
    }
    public function formAgregarModelo() {
        require_once __DIR__ . '/templates/modeloTemplate/formAgregarModelo.phtml';
    }
    public function renderEditarModelo($modelo) {
        require_once __DIR__ . '/templates/modeloTemplate/formEditarModelo.phtml';
    }
    public function renderModelos($modelos) {
        require_once __DIR__ . '/templates/modeloTemplate/listarModelos.phtml';
    }
    public function renderModelosAdmin($modelos) {
        require_once __DIR__ . '/templates/modeloTemplate/listarModelosAdmin.phtml';
    }
}