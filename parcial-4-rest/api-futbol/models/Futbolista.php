<?php
// Autor: Brant Santana Gonzalez Arenas
// Fecha: 07/04/2026

class Futbolista {
    private $conn;
    private $table_name = "futbolistas";

    public $id;
    public $nombre;
    public $posicion;
    public $numero;
    public $edad;
    public $equipo;

    public function __construct($db) {
        $this->conn = $db;
    }

    private function validar() {
        $errores = [];
        if (empty($this->nombre)) $errores[] = "El nombre es obligatorio";
        if (empty($this->posicion)) $errores[] = "La posición es obligatoria";
        if (!is_numeric($this->numero) || $this->numero < 1 || $this->numero > 99) $errores[] = "El número debe ser entre 1 y 99";
        if (!is_numeric($this->edad) || $this->edad < 16 || $this->edad > 50) $errores[] = "La edad debe ser entre 16 y 50 años";
        if (empty($this->equipo)) $errores[] = "El equipo es obligatorio";
        return $errores;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $errores = $this->validar();
        if (!empty($errores)) {
            return ["success" => false, "errores" => $errores];
        }
        $query = "INSERT INTO " . $this->table_name . " (nombre, posicion, numero, edad, equipo) VALUES (:nombre, :posicion, :numero, :edad, :equipo)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":posicion", $this->posicion);
        $stmt->bindParam(":numero", $this->numero);
        $stmt->bindParam(":edad", $this->edad);
        $stmt->bindParam(":equipo", $this->equipo);
        if($stmt->execute()) {
            return ["success" => true, "message" => "Futbolista creado correctamente"];
        }
        return ["success" => false, "message" => "Error al crear el futbolista"];
    }

    public function update() {
        $errores = $this->validar();
        if (!empty($errores)) {
            return ["success" => false, "errores" => $errores];
        }
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, posicion = :posicion, numero = :numero, edad = :edad, equipo = :equipo WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":posicion", $this->posicion);
        $stmt->bindParam(":numero", $this->numero);
        $stmt->bindParam(":edad", $this->edad);
        $stmt->bindParam(":equipo", $this->equipo);
        $stmt->bindParam(":id", $this->id);
        if($stmt->execute()) {
            return ["success" => true, "message" => "Futbolista actualizado correctamente"];
        }
        return ["success" => false, "message" => "Error al actualizar el futbolista"];
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        if($stmt->execute()) {
            return ["success" => true, "message" => "Futbolista eliminado correctamente"];
        }
        return ["success" => false, "message" => "Error al eliminar el futbolista"];
    }
}
?>