<?php
// CONFIGURACIÓN
$host = "localhost";
$db = "escuela";
$user = "root";
$pass = "";

$mensaje = "";

try {
    // Conexión PDO con excepciones
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // PROCESAR FORMULARIO
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $nombre = trim($_POST["nombre"]);
        $apellido = trim($_POST["apellido"]);
        $correo = trim($_POST["correo"]);
        $simularError = isset($_POST["simular_error"]);
        
        if ($nombre == "" || $apellido == "" || $correo == "") {
            $mensaje = "❌ Todos los campos son obligatorios.";
        } else {
            try {
                // Iniciar transacción
                $pdo->beginTransaction();
                
                // Insertar alumno
                $sql = "INSERT INTO alumnos (nombre, apellido, correo) VALUES (:nombre, :apellido, :correo)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ":nombre" => $nombre,
                    ":apellido" => $apellido,
                    ":correo" => $correo
                ]);
                $idAlumno = $pdo->lastInsertId();
                
                // Simular error si está marcado
                if ($simularError) {
                    throw new Exception("ERROR SIMULADO - Rollback ejecutado");
                }
                
                // Insertar log
                $sqlLog = "INSERT INTO logs (idAlumno, accion) VALUES (:idAlumno, :accion)";
                $stmtLog = $pdo->prepare($sqlLog);
                $stmtLog->execute([
                    ":idAlumno" => $idAlumno,
                    ":accion" => "ALTA_ALUMNO"
                ]);
                
                // Confirmar transacción
                $pdo->commit();
                $mensaje = "✅ COMMIT exitoso. Alumno registrado con ID: $idAlumno";
                
            } catch (Exception $e) {
                // Revertir todo
                if ($pdo->inTransaction()) {
                    $pdo->rollBack();
                }
                $mensaje = "❌ ROLLBACK ejecutado. Error: " . $e->getMessage();
            }
        }
    }
    
    // Consultar registros para mostrar
    $alumnos = $pdo->query("SELECT * FROM alumnos ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    $logs = $pdo->query("SELECT * FROM logs ORDER BY idLog DESC")->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    $mensaje = "Error de conexión: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Transacciones PDO</title>
    <style>
        body { font-family: Arial; max-width: 1000px; margin: 0 auto; padding: 20px; background: #f5f5f5; }
        .card { background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        input[type="text"], input[type="email"] { width: 100%; padding: 8px; margin: 5px 0; box-sizing: border-box; }
        .btn { background: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        .msg { padding: 10px; border-radius: 4px; margin-top: 10px; }
        .success { background: #e8f5e9; color: #2e7d32; border-left: 4px solid #4CAF50; }
        .error { background: #ffebee; color: #c62828; border-left: 4px solid #f44336; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #4CAF50; color: white; }
        .row { display: flex; gap: 15px; }
        .row div { flex: 1; }
    </style>
</head>
<body>
    <h1>📚 Registro de Alumnos con Transacciones</h1>
    
    <div class="card">
        <form method="POST">
            <div class="row">
                <div>
                    <label>Nombre:</label>
                    <input type="text" name="nombre" required>
                </div>
                <div>
                    <label>Apellido:</label>
                    <input type="text" name="apellido" required>
                </div>
                <div>
                    <label>Correo:</label>
                    <input type="email" name="correo" required>
                </div>
            </div>
            
            <p>
                <input type="checkbox" name="simular_error">
                🔴 Simular error (forzar ROLLBACK)
            </p>
            
            <button class="btn" type="submit">Registrar alumno</button>
        </form>
        
        <?php if ($mensaje): ?>
            <div class="msg <?= strpos($mensaje, 'COMMIT') !== false ? 'success' : 'error' ?>">
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="card">
        <h3>📋 Tabla: alumnos</h3>
        <table>
            <thead>
                <tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Correo</th></tr>
            </thead>
            <tbody>
                <?php foreach ($alumnos as $a): ?>
                <tr>
                    <td><?= htmlspecialchars($a['id']) ?></td>
                    <td><?= htmlspecialchars($a['nombre']) ?></td>
                    <td><?= htmlspecialchars($a['apellido']) ?></td>
                    <td><?= htmlspecialchars($a['correo']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="card">
        <h3>📋 Tabla: logs</h3>
        <table>
            <thead>
                <tr><th>ID Log</th><th>ID Alumno</th><th>Acción</th><th>Fecha</th></tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $l): ?>
                <tr>
                    <td><?= htmlspecialchars($l['idLog']) ?></td>
                    <td><?= htmlspecialchars($l['idAlumno']) ?></td>
                    <td><?= htmlspecialchars($l['accion']) ?></td>
                    <td><?= htmlspecialchars($l['fecha']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>