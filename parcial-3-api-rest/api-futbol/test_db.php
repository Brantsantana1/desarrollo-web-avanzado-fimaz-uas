<?php
// Autor: Brant Santana Gonzalez Arenas
// Prueba de la clase Database

require_once "config/Database.php";

$database = new Database();
$conn = $database->getConnection();

if($conn) {
    echo "✅ Clase Database funcionando correctamente<br>";
    
    $query = "SELECT nombre, equipo FROM futbolistas LIMIT 3";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['nombre'] . " juega en " . $row['equipo'] . "<br>";
    }
} else {
    echo "❌ Error en la clase Database";
}
?>