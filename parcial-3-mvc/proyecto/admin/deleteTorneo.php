<?php
require_once("../controllers/torneosController.php");

// Instanciamos el controlador
$objTorneosController = new torneosController();

// Verificar que se recibió un ID válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Llamar al método delete del controlador
    $objTorneosController->delete($_GET['id']);
} else {
    // Si no hay ID, redirigir al listado
    header("Location: lista_torneos.php");
    exit();
}
?>