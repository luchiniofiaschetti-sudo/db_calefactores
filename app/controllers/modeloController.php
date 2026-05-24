<?php

require_once __DIR__ . '/../models/calefactorModel.php';
require_once __DIR__ . '/../models/modeloModel.php';
require_once __DIR__ . '/../view/modeloVista.php';
require_once __DIR__ . '/../view/calefactorVista.php';
require_once __DIR__ . '/../view/errorView.php';
class ModeloController {  
    private $modelo;
    private $calefactorModel;

    private $vista;
    
    private $vistaCalefactor;

    private $error;
    public function __construct() {
        $this->modelo = new ModeloModel();
        $this->calefactorModel = new CalefactorModel(); 
        $this -> vista = new modeloVista();
        $this -> vistaCalefactor = new calefactorVista();
        $this -> error = new ErrorView();
    }

    public function mostrarModelos($req) {
        $modelos = $this->modelo->getModelos();
        $this -> vista->setAdmin($req->admin);
        $this -> vista->renderModelos($modelos);
    }

    public function mostrarModelo($id_modelo, $req) {
        if (empty($id_modelo)){
            $this -> error -> mensaje('El id no existe');
        }
        $calefactores = $this->calefactorModel->getCalefactoresPorModelo($id_modelo);
        $this ->vistaCalefactor->setAdmin($req->admin);
        $this ->vistaCalefactor->renderCalefactores($calefactores);
    }
}