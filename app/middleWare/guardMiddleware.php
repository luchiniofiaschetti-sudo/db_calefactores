<?php

class GuardMiddleWare {

    public function run($req) {

        if(!$req->admin) {
            header('Location: '. BASE_URL . 'login');
            die();
        }
        return $req;
    }
}