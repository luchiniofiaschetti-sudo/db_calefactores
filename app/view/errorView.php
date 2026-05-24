<?php

class ErrorView {
   
    public function mensaje($err) {
        require_once __DIR__ . '/templates/error.phtml';
    }
}