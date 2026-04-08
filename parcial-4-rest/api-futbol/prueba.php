<?php
// Autor: Brant Santana Gonzalez Arenas
// Fecha: 07/04/2026
// Prueba de conexión a la base de datos

echo "<h1>Prueba de conexión</h1>";

try {
    $conn = new PDO("mysql:host=localhost;dbname=futbolistas", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Conexión exitosa a la base de datos 'futbolistas'<br>";
    
    $query = "SELECT * FROM futbolistas";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $futbolistas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Futbolistas registrados:</h2>";
    echo "<ul>";
    foreach($futbolistas as $f) {
        echo "<li>" . $f['id'] . " - " . $f['nombre'] . " - " . $f['posicion'] . " - " . $f['numero'] . " - " . $f['edad'] . " años - " . $f['equipo'] . "</li>";
    }
    echo "</ul>";
    
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>