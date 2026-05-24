<?php
require_once __DIR__ . '/../models/adminCalefactorModel.php';
require_once __DIR__ . '/../models/adminModeloModel.php';
require_once __DIR__ . '/../view/calefactorVista.php';
require_once __DIR__ . '/../view/errorView.php';

class AdminCalefactorController {
    private $modelo;
    private $modeloModel;
    private $vista;
    private $error;
   
    public function __construct(){
        $this ->modelo = new AdminCalefactorModel();
        $this->modeloModel = new AdminModeloModel();
        $this -> vista = new calefactorVista();
        $this->error = new ErrorView();
    }
    
    public function listarCalefactores($req){
        $calefactores = $this->modelo->listarCalefactores();
        $this->vista->setAdmin($req->admin);
        foreach ($calefactores as $c){
            $modelito = $this ->modeloModel -> getModeloById($c->id_modelo);
            $c -> modeloNombre = $modelito -> nombre;
        }
        $this->vista->renderCalefactoresAdmin($calefactores);
    }
    public function formAgregarCalefactor($req) {
        $modelos = $this->modeloModel->listaModelos();
        $this->vista->setAdmin($req->admin);
        $this->vista->formAgregarCalefactor($modelos);
    }

    public function agregarCalefactores($req){
        $nombre = $_POST['nombre'] ?? null;
        $tipo = $_POST['tipo'] ?? null;
        $potencia = $_POST['potencia'] ?? null;
        $peso = $_POST['peso'] ?? null;
        $precio = $_POST['precio'] ?? null;
        $stock = $_POST['stock'] ?? null;
        $id_modelo = $_POST['id_modelo'] ?? null;
       
        $agregado = $this->modelo->agregarCalefactor($nombre, $tipo, $potencia, $peso, $precio, $stock, $id_modelo);
        
        if ($agregado){
            header("Location: " . BASE_URL . "listar-calefactores");
            exit;
        } else {
            $this->error->mensaje('Error al agregar el calefactor.');
        }
    }

    public function formEditarCalefactor($req, $id) {
        if (empty($id)) {
            $this->error->mensaje('Error: ID de calefactor no válido para editar.');
            return;
        }

        $calefactor = $this->modelo->getCalefactorId($id);
        $this->vista->setAdmin($req->admin);
        $this->vista->formEditarCalefactor($calefactor);
    }

    public function editarCalefactor($req, $id) {
        if (!isset($id)) {
            $this->error->mensaje('Error: Falta el ID del calefactor para confirmar la edición.');
            return;
        }

        $nombre = $_POST['nombre'] ?? null;
        $tipo = $_POST['tipo'] ?? null;
        $potencia = $_POST['potencia'] ?? null;
        $peso = $_POST['peso'] ?? null;
        $precio = $_POST['precio'] ?? null;
        $stock = $_POST['stock'] ?? null;

        $editado = $this->modelo->editarCalefactor($nombre, $tipo, $potencia, $peso, $precio, $stock, $id);
        if($editado) {    
            header("Location: " . BASE_URL . "listar-calefactores");
            exit;
        } else {                                              
            $this->error->mensaje('Error al editar el calefactor.');
        }
    }

    public function formEliminarCalefactor($req, $id) {
        if (!isset($id)) {
            $this->error->mensaje('Error: ID de calefactor no válido para eliminar.');
            return;
        }

        $calefactor = $this->modelo->getCalefactorId($id);
        $this->vista->setAdmin($req->admin);
        $this->vista->formEliminarCalefactor($calefactor);
    }

    public function eliminarCalefactor($req, $id) {
        if (empty($id)) {
            $this->error->mensaje('Error: Falta el ID del calefactor para confirmar la eliminación.');
            return;
        }

        $eliminado = $this->modelo->eliminarCalefactor($id);

        if($eliminado) {
            header("Location: " . BASE_URL . "listar-calefactores");
            exit;
        } else {                                              
            $this->error->mensaje('Error al eliminar el calefactor.');
        }
    }
}