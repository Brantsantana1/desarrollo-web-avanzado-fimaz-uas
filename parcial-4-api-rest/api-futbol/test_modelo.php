<?php
require_once "config/Database.php";
require_once "models/Futbolista.php";

$database = new Database();
$db = $database->getConnection();
$futbolista = new Futbolista($db);

$resultados = $futbolista->getAll();
echo "<pre>";
print_r($resultados);
echo "</pre>";
?>