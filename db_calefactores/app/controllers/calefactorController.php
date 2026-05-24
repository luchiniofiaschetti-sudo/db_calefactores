<?php
require_once __DIR__ . '/../models/calefactorModel.php';
require_once __DIR__ . '/../models/modeloModel.php';
require_once __DIR__ . '/../view/calefactorVista.php';
require_once __DIR__ . '/../view/errorView.php';

class CalefactorController {
    
    private $model;
    private $vista;
    private $error;

    private $modeloModelo;
    public function __construct() {
        $this->model = new CalefactorModel();
        $this -> modeloModelo = new ModeloModel();
        $this->vista = new calefactorVista();
        $this -> error = new ErrorView(); 
    }

    public function mostrarDetalle($id, $req) {
        if (empty($id)) {
            $this->error->mensaje('Error: ID de calefactor no válido.');
            return;
        }
        $calefactor = $this->model->mostrarDetalle($id);

        if (!$calefactor) {
            $this->error->mensaje('El calefactor solicitado no existe.');
            return;
        }
        $calefactor -> modeloPropio = $this ->modeloModelo -> getModeloById($calefactor->id_modelo);
        $this->vista->setAdmin($req->admin);
        $this->vista->renderDetalleCalefactor($calefactor);
    }

    public function mostrarCalefactores($req) {
        $calefactores = $this->model->mostrarCalefactores();
        $this->vista->setAdmin($req->admin);
        $this->vista->renderCalefactores($calefactores);
    }
}
