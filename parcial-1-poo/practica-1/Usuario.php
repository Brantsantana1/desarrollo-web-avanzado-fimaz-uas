<?php
// Clase Usuario
// Demuestra encapsulamiento con atributos privados,
// constructor, getters y setters

class Usuario {

    // Atributos privados
    private $nombre;
    private $correo;

    // Constructor
    public function __construct($nombre, $correo) {
        $this->nombre = $nombre;
        $this->correo = $correo;
    }

    // Getter de nombre
    public function getNombre() {
        return $this->nombre;
    }

    // Getter de correo
    public function getCorreo() {
        return $this->correo;
    }

    // Setter de nombre
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Setter de correo
    public function setCorreo($correo) {
        $this->correo = $correo;
    }
}
