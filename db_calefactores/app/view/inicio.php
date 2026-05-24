<?php

class ShowInicio {
    protected $admin;

    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    public function renderInicio($modelos) {
        require_once __DIR__ . '/templates/inicio.phtml';
    }
}