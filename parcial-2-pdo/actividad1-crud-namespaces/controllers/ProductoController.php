<?php

namespace Controllers;

use Config\Database;
use Models\Producto;
use PDO;

class ProductoController {

    private $connection;

    public function __construct() {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    // CREAR
    public function crear(Producto $producto) {
        $sql = "INSERT INTO productos (nombre, descripcion, existencia, precio) VALUES (:nombre, :descripcion, :existencia, :precio)";
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            ':nombre' => $producto->getNombre(),
            ':descripcion' => $producto->getDescripcion(),
            ':existencia' => $producto->getExistencia(),
            ':precio' => $producto->getPrecio()
        ]);
    }

    // LISTAR
    public function listar() {
        $sql = "SELECT * FROM productos ORDER BY id DESC";
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll();
    }

    // OBTENER POR ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // ACTUALIZAR
    public function actualizar(Producto $producto) {
        $sql = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, existencia = :existencia, precio = :precio WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            ':id' => $producto->getId(),
            ':nombre' => $producto->getNombre(),
            ':descripcion' => $producto->getDescripcion(),
            ':existencia' => $producto->getExistencia(),
            ':precio' => $producto->getPrecio()
        ]);
    }

    // ELIMINAR
    public function eliminar($id) {
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}