<?php

namespace Models;

class Producto {
    private $id;
    private $nombre;
    private $descripcion;
    private $existencia;
    private $precio;

    // GETTERS

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getExistencia() {
        return $this->existencia;
    }

    public function getPrecio() {
        return $this->precio;
    }

    // SETTERS

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setExistencia($existencia) {
        $this->existencia = $existencia;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }
}