<?php

require_once __DIR__ . '/../models/modeloModel.php';
require_once __DIR__ . '/../view/inicio.php';

class InicioController {
    private $modelo;

    public function __construct() {
        $this->modelo = new ModeloModel();    
    }
    
    public function showInicio($req) {
        $modelos = $this->modelo->getModelos();
        $vista = new ShowInicio();
        $vista->setAdmin($req->admin);
        $vista->renderInicio($modelos);
    }
}