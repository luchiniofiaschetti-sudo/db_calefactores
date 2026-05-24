<?php

session_start();

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/app/middleWare/guardMiddleware.php';
require_once __DIR__ . '/app/middleWare/sessionMiddleware.php';
require_once __DIR__ . '/app/controllers/inicioController.php';
require_once __DIR__ . '/app/controllers/calefactorController.php';
require_once __DIR__ . '/app/controllers/modeloController.php';
require_once __DIR__ . '/app/controllers/loginController.php';
require_once __DIR__ . '/app/controllers/logoutController.php';
require_once __DIR__ . '/app/controllers/adminController.php';
require_once __DIR__ . '/app/controllers/adminModeloController.php';
require_once __DIR__ . '/app/controllers/adminCalefactorController.php';

/**  TABLA DE RUTEO
 *   Publico
 *   /inicio                      -> InicioController::showInicio($req)
 *   /calefactores                -> CalefactorController::mostrarCalefactores($req)
 *   /calefactor/:id              -> CalefactorController::mostrarDetalle($id, $req)
 *   /modelos                     -> ModeloController::mostrarModelos($req)
 *   /modelo/:id                  -> ModeloController::mostrarModelo($id, $req)
 *   /login                       -> LoginController::formLogin($req)
 *   /confirmar-login             -> LoginController::confirmarLogin()
 *
 *   Administrador      -------
 *   /logout                      -> LogoutController::destruirSesion()
 *   /confirmar-logout            -> LogoutController::confirmarLogout($req)
 *   /admin                       -> AdminController::panelAdmin($req)
 *
 *   AdminModelos
 *   /listar-modelos              -> AdminModeloController::listarModelos($req)
 *   /listar-modelo/:id           -> AdminModeloController::listarModelo($id, $req)
 *   /agregar-modelo              -> AdminModeloController::formAgregarModelo($req)
 *   /confirmar-agregar-modelo    -> AdminModeloController::agregarModelo($req)
 *   /editar-modelo/:id           -> AdminModeloController::panelEdicionModelo($id, $req)
 *   /confirmar-edicion-modelo    -> AdminModeloController::editarModelo($req)
 *   /eliminar-modelo/:id         -> AdminModeloController::confirmarEliminacion($id, $req)
 *   /confirmar-eliminacion-modelo/:id -> AdminModeloController::eliminarModelo($id, $req)
 *
 *   AdminCalefactores
 *   /listar-calefactores         -> AdminCalefactorController::listarCalefactores($req)
 *   /agregar-calefactor          -> AdminCalefactorController::formAgregarCalefactor($req)
 *   /confirmar-agregar-calefactor-> AdminCalefactorController::agregarCalefactores($req)
 *   /editar-calefactor/:id       -> AdminCalefactorController::formEditarCalefactor($id, $req)
 *   /confirmar-editar-calefactor/:id -> AdminCalefactorController::editarCalefactor($req, $id)
 *   /eliminar-calefactor/:id     -> AdminCalefactorController::formEliminarCalefactor($req, $id)
 *   /confirmar-eliminar-calefactor/:id -> AdminCalefactorController::eliminarCalefactor($req, $id)
 **/

$action = 'inicio';

   if(isset($_GET['action']) && !empty($_GET['action'])) {
      $action = $_GET['action'];
   }

$parametros = explode('/', $action);

$req = new StdClass();
$req = (new SessionMiddleware())->run($req);

 switch ($parametros[0]) {
    
         //publico
    case 'inicio': 
         $control = new InicioController();
         $control->showInicio($req);
         break;

    case 'calefactores':
         $control = new CalefactorController();
         $control->mostrarCalefactores($req);
         break;

    case 'calefactor':
         $id = $parametros[1] ?? null;
         $control = new CalefactorController();
         $control->mostrarDetalle($id, $req); 
         break;

     case 'modelos':
         $modelos = new ModeloController();
         $modelos->mostrarModelos($req);
         break;  
        
      case 'modelo':
         $id = $parametros[1] ?? null;
         $modelo = new ModeloController();
         $modelo->mostrarModelo($id, $req);
         break;

      case 'login':
         $login = new LoginController();
         $login->formLogin($req);
         break;    

         //Administrador

      case 'confirmarLogin':
         $confirmar = new LoginController();
         $confirmar->confirmarlogin();
         break;
         
      case 'confirmar-logout':
         $req = (new GuardMiddleWare())->run($req);
         $logout = new LogoutController();
         $logout->confirmarLogout($req);
         break;

      case 'logout':
         $logout = new LogoutController();
         $logout->destruirSesion();
         break;

      case 'admin':
         $req = (new GuardMiddleWare())->run($req);
         $administrador = new AdminController();
         $administrador->panelAdmin($req);
         break;
         
         //AdminModelo
      case 'listar-modelos':
         $req = (new GuardMiddleWare())->run($req);
         $modelos = new AdminModeloController();
         $modelos->listarModelos($req); 
         break;

      case 'listar-modelo':
         $req = (new GuardMiddleWare())->run($req);
         $id = $parametros[1] ?? null;
         $modelo = new AdminModeloController();
         $modelo->listarModelo($id, $req);
         break; 

      case 'agregar-modelo':
         $req = (new GuardMiddleWare())->run($req);
         $agregar = new AdminModeloController();
         $agregar->formAgregarModelo($req);
         break;

      case 'confirmar-agregar-modelo':
         $req = (new GuardMiddleWare())->run($req);
         $controller = new AdminModeloController();
         $controller->agregarModelo($req);
         break;
         
      case 'editar-modelo':
         $req = (new GuardMiddleWare())->run($req);
         $id = $parametros[1] ?? null;
         $editar = new AdminModeloController();
         $editar->panelEdicionModelo($id, $req);
         break;

      case 'confirmar-edicion-modelo':
         $req = (new GuardMiddleWare())->run($req);
         $confirmar = new AdminModeloController();
         $confirmar->editarModelo($req);
         break;

      case 'eliminar-modelo':
         $req = (new GuardMiddleWare())->run($req);
         $id = $parametros[1] ?? null;
         $eliminar = new AdminModeloController();
         $eliminar->confirmarEliminacion($id, $req);
         break;

      case 'confirmar-eliminacion-modelo':
         $req = (new GuardMiddleWare())->run($req);
         $id = $parametros[1] ?? null;
         $eliminar = new AdminModeloController();
         $eliminar->eliminarModelo($id, $req);
         break;
      
         //AdminCalefactor
      case 'listar-calefactores':
         $req = (new GuardMiddleWare())->run($req);
         $calefactores = new AdminCalefactorController();
         $calefactores->listarCalefactores($req);
         break;

      case 'agregar-calefactor':
         $req = (new GuardMiddleWare())->run($req);
         $agregar = new AdminCalefactorController();
         $agregar->formAgregarCalefactor($req);
         break;

      case 'confirmar-agregar-calefactor':
         $req = (new GuardMiddleWare())->run($req);
         $agregado = new AdminCalefactorController();
         $agregado->agregarCalefactores($req);
         break;
      
      case 'editar-calefactor':
         $req = (new GuardMiddleWare)->run($req);
         $id = $parametros[1] ?? null;
         $editar = new AdminCalefactorController();
         $editar->formEditarCalefactor($req, $id);
         break;

      case 'confirmar-editar-calefactor':
         $req = (new GuardMiddleWare())->run($req);
         $id = $parametros[1] ?? null;
         $editado = new AdminCalefactorController();
         $editado->editarCalefactor($req, $id); 
         break;

      case 'eliminar-calefactor':
         $req = (new GuardMiddleWare())->run($req);
         $id = $parametros[1] ?? null;
         $eliminar = new AdminCalefactorController();
         $eliminar->formEliminarCalefactor($req, $id);
         break;

      case 'confirmar-eliminar-calefactor':
         $req = (new GuardMiddleWare())->run($req);
         $id = $parametros[1] ?? null;
         $eliminado = new AdminCalefactorController();
         $eliminado->eliminarCalefactor($req, $id);
         break;
   }