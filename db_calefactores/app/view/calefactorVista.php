<?php

class calefactorVista {

    protected $admin;

    public function setAdmin($admin) {
        $this->admin = $admin;
    }
    public function formEliminarCalefactor($calefactor) {
        require_once __DIR__ . '/templates/calefactorTemplate/confirmarEliminarCalefactor.phtml';
    }
    public function renderDetalleCalefactor($calefactor) {
        require __DIR__ . '/templates/calefactorTemplate/detalleCalefactor.phtml';
    }
    public function formAgregarCalefactor($modelos) {
        require_once __DIR__ . '/templates/calefactorTemplate/formAgregarCalefactor.phtml';
    }
    public function formEditarCalefactor($calefactor) {
        include_once __DIR__ . '/templates/calefactorTemplate/formEditarCalefactor.phtml';
    }
    public function renderCalefactores($calefactores) {
        require_once __DIR__ . '/templates/calefactorTemplate/listarCalefactores.phtml';
    }
    public function renderCalefactoresAdmin($calefactores) {
        require_once __DIR__ . '/templates/calefactorTemplate/listarCalefactoresAdmin.phtml';
    }

}