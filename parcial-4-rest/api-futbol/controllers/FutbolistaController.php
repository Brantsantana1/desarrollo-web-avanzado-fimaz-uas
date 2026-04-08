<?php
// Autor: Brant Santana Gonzalez Arenas
// Fecha: 07/04/2026

require_once "models/Futbolista.php";

class FutbolistaController {
    private $db;
    private $futbolista;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->futbolista = new Futbolista($this->db);
    }

    // GET /futbolistas
    public function getAll() {
        $result = $this->futbolista->getAll();
        http_response_code(200);
        echo json_encode(["success" => true, "data" => $result]);
    }

    // GET /futbolistas/{id}
    public function getById($id) {
        $this->futbolista->id = $id;
        $result = $this->futbolista->getById();
        if($result) {
            http_response_code(200);
            echo json_encode(["success" => true, "data" => $result]);
        } else {
            http_response_code(404);
            echo json_encode(["success" => false, "error" => "Futbolista no encontrado"]);
        }
    }

    // POST /futbolistas
    public function create() {
        $data = json_decode(file_get_contents("php://input"), true);
        
        if(!$data) {
            http_response_code(400);
            echo json_encode(["success" => false, "error" => "Datos inválidos"]);
            return;
        }

        $this->futbolista->nombre = $data['nombre'] ?? '';
        $this->futbolista->posicion = $data['posicion'] ?? '';
        $this->futbolista->numero = $data['numero'] ?? '';
        $this->futbolista->edad = $data['edad'] ?? '';
        $this->futbolista->equipo = $data['equipo'] ?? '';

        $result = $this->futbolista->create();
        
        if($result['success']) {
            http_response_code(201);
            echo json_encode($result);
        } else {
            http_response_code(400);
            echo json_encode($result);
        }
    }

    // PUT /futbolistas/{id}
    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        
        if(!$data) {
            http_response_code(400);
            echo json_encode(["success" => false, "error" => "Datos inválidos"]);
            return;
        }

        $this->futbolista->id = $id;
        $this->futbolista->nombre = $data['nombre'] ?? '';
        $this->futbolista->posicion = $data['posicion'] ?? '';
        $this->futbolista->numero = $data['numero'] ?? '';
        $this->futbolista->edad = $data['edad'] ?? '';
        $this->futbolista->equipo = $data['equipo'] ?? '';

        $result = $this->futbolista->update();
        
        if($result['success']) {
            http_response_code(200);
            echo json_encode($result);
        } else {
            http_response_code(400);
            echo json_encode($result);
        }
    }

    // DELETE /futbolistas/{id}
    public function delete($id) {
        $this->futbolista->id = $id;
        $result = $this->futbolista->delete();
        
        if($result['success']) {
            http_response_code(200);
            echo json_encode($result);
        } else {
            http_response_code(404);
            echo json_encode($result);
        }
    }
}
?>