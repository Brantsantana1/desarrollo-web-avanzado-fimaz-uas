<?php
require_once("../controllers/torneosController.php");

// Instanciamos nuestro Controlador
$objController = new torneosController();

// Obtener valores del formulario con POST
$id = $_POST['txtId'];
$nombreTorneo = $_POST['txtNombreTorneo'];
$organizador = $_POST['txtOrganizador'];
$patrocinadores = $_POST['txtPatrocinador'];
$sede = $_POST['txtSede'];
$categoria = $_POST['txtCategoria'];
$premio1 = $_POST['txtPremio1'];
$premio2 = $_POST['txtPremio2'];
$premio3 = $_POST['txtPremio3'];
$otroPremio = $_POST['txtOtroPremio'];

// Llamar al método updateTorneo del controlador
$objController->updateTorneo(
    $id, 
    $nombreTorneo, 
    $organizador, 
    $patrocinadores, 
    $sede, 
    $categoria, 
    $premio1, 
    $premio2, 
    $premio3, 
    $otroPremio
);
?>