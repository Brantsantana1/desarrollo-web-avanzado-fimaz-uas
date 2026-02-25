<?php
require_once __DIR__ . "/Usuario.php";

class Admin extends Usuario {

    public function getRol() {
        return "Administrador";
    }
}