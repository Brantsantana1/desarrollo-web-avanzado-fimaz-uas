<?php
// ==============================================
// AUTOR: Brant Santana Gonzalez Arenas
// FECHA: 07/04/2026
// DESCRIPCIÓN: API REST para gestión de futbolistas
// ==============================================

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

// Para peticiones OPTIONS (preflight de CORS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once "config/Database.php";
require_once "controllers/FutbolistaController.php";

// Obtener la ruta de la URL
$request_uri = $_SERVER['REQUEST_URI'];
$base_path = '/api-futbol/';

// Limpiar la ruta
if (strpos($request_uri, $base_path) === 0) {
    $path = substr($request_uri, strlen($base_path));
} else {
    $path = $request_uri;
}

$path = trim($path, '/');
$segments = explode('/', $path);

$resource = $segments[0] ?? null;
$id = isset($segments[1]) && is_numeric($segments[1]) ? $segments[1] : null;

$controller = new FutbolistaController();
$method = $_SERVER['REQUEST_METHOD'];

// Router
if ($resource === 'futbolistas') {
    switch ($method) {
        case 'GET':
            if ($id) {
                $controller->getById($id);
            } else {
                $controller->getAll();
            }
            break;
        case 'POST':
            $controller->create();
            break;
        case 'PUT':
            if ($id) {
                $controller->update($id);
            } else {
                http_response_code(400);
                echo json_encode(["success" => false, "error" => "ID requerido para actualizar"]);
            }
            break;
        case 'DELETE':
            if ($id) {
                $controller->delete($id);
            } else {
                http_response_code(400);
                echo json_encode(["success" => false, "error" => "ID requerido para eliminar"]);
            }
            break;
        default:
            http_response_code(405);
            echo json_encode(["success" => false, "error" => "Método no permitido"]);
    }
} else {
    http_response_code(404);
    echo json_encode(["success" => false, "error" => "Endpoint no encontrado. Usa /futbolistas"]);
}
?>