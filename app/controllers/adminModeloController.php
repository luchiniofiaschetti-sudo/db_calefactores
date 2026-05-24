<?php

require_once __DIR__ . '/../models/adminModeloModel.php';
require_once __DIR__ . '/../models/admincalefactorModel.php';
require_once __DIR__ . '/../view/modeloVista.php';
require_once __DIR__ . '/../view/errorView.php';
require_once __DIR__ . '/../view/calefactorVista.php';

class AdminModeloController {
    
    private $modelo;
    private $modeloCalefactor;
    private $vista;
    private $vistaCalefactor;
    private $error;
  
    public function __construct() {
        $this->modelo = new AdminModeloModel();
        $this->modeloCalefactor = new AdminCalefactorModel();
        $this->error = new ErrorView(); 
        $this->vista = new ModeloVista();
        $this->vistaCalefactor = new CalefactorVista();
    }

    public function listarModelos($req) {
        $modelos = $this->modelo->listaModelos();
        $this->vista->setAdmin($req->admin);  
        $this->vista->renderModelosAdmin($modelos);
    }

    public function listarModelo($id, $req) {
        if (empty($id)) {
            $this->error->mensaje('El id no existe o no es válido');
            return;
        }
        $calefactores = $this->modeloCalefactor->getCalefactoresPorModelo($id);
        $this->vistaCalefactor->setAdmin($req->admin);
        foreach ($calefactores as $c) {
            $modelito = $this->modelo->getModeloById($c->id_modelo);
            if ($modelito) {
                $c->modeloNombre = $modelito->nombre;
            } else {
                $c->modeloNombre = 'Sin modelo';
            }
        }
        $this->vistaCalefactor->renderCalefactoresAdmin($calefactores);
    }

    public function formAgregarModelo($req) {
        $this->vista->setAdmin($req->admin);
        $this->vista->formAgregarModelo();
    }

    public function agregarModelo($req) {
        $nombre = $_POST['nombre'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;
        $categoria = $_POST['categoria'] ?? null;
    
        if (empty($nombre) || empty($descripcion) || empty($categoria)) {
            $this->error->mensaje('Faltan campos obligatorios para agregar el modelo');
            return;
        }

        $imagen = null;
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
            $nombreArchivo = basename($_FILES['imagen']['name']);
            $rutaDestino = 'assets/img/' . $nombreArchivo;
            move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino);
            $imagen = $rutaDestino;
        }
    
        $agregado = $this->modelo->agregarModelo($nombre, $descripcion, $categoria, $imagen);
    
        if ($agregado !== false) {
            header("Location: " . BASE_URL . "listar-modelos");
        } else {
            $this->error->mensaje('Error al agregar Modelo');
        }
    }

    public function confirmarEliminacion($id, $req) {
        if (empty($id)) {
            $this->error->mensaje('El id no existe o no es válido');
            return;
        }
        $model = $this->modelo->getModeloId($id);
        if (!$model) {
            $this->error->mensaje('El modelo solicitado no existe');
            return;
        }
        $this->vista->setAdmin($req->admin);
        $this->vista->confirmarEliminacionModelo($model);
    }

    public function eliminarModelo($id, $req) {
        if (empty($id)) {
            $this->error->mensaje('El id no existe o no es válido');
            return;
        }
        $eliminado = $this->modelo->eliminarModelo($id);

        if ($eliminado) {
            header("Location: " . BASE_URL . "listar-modelos");
        } else {
            $this->error->mensaje('Error al eliminar Modelo');
        }
    }

    public function panelEdicionModelo($id, $req) {
        if (empty($id)) {
            $this->error->mensaje('El id no existe o no es válido');
            return;
        }
        $modelo = $this->modelo->getModeloId($id);
        if (!$modelo) {
            $this->error->mensaje('El modelo solicitado no existe');
            return;
        }
        $this->vista->setAdmin($req->admin);
        $this->vista->renderEditarModelo($modelo); 
    }

    public function editarModelo($req) {
        $id = $_POST['id'] ?? null;
        $nombre = $_POST['nombre'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;
        $categoria = $_POST['categoria'] ?? null;

        if (empty($id) || empty($nombre) || empty($descripcion) || empty($categoria)) {
            $this->error->mensaje('Faltan campos obligatorios para editar el modelo');
            return;
        }

        $imagen = null;
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
            $nombreArchivo = basename($_FILES['imagen']['name']);
            $rutaDestino = 'assets/img/' . $nombreArchivo;
            move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino);
            $imagen = $rutaDestino;
        }
        
        $editado = $this->modelo->editarModelo($id, $nombre, $descripcion, $categoria, $imagen);
        
        if ($editado) { 
            header("Location: " . BASE_URL . "listar-modelos");
        } else {
            $this->error->mensaje('Error al editar Modelo');
        }
    }
}