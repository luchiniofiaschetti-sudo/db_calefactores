<?php

class SessionMiddleware {
   
    public function run($req) {
        
        if(isset($_SESSION['id']) && $_SESSION['rol'] === 'administrador') {
            $req->admin = new StdClass();
            $req->admin->id = $_SESSION['id'];
            $req->admin->nombre = $_SESSION['nombre'];
        }else{
            $req->admin = null;
        } 
        return $req;
    }
}