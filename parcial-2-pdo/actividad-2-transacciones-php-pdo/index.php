<?php
$mensaje = "";

try {
    $conexion = new PDO("mysql:host=localhost;dbname=escuela", "root", "");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $error = isset($_POST["error"]);

        $conexion->beginTransaction();

        $sql1 = "INSERT INTO alumnos(nombre, correo) VALUES(:nombre, :correo)";
        $stmt1 = $conexion->prepare($sql1);
        $stmt1->execute([
            ":nombre" => $nombre,
            ":correo" => $correo
        ]);

        if ($error) {
            throw new Exception("Error simulado");
        }

        $sql2 = "INSERT INTO logs(mensaje) VALUES('Alumno registrado correctamente')";
        $conexion->exec($sql2);

        $conexion->commit();
        $mensaje = "COMMIT realizado correctamente";
    }
} catch (Exception $e) {

    if ($conexion->inTransaction()) {
        $conexion->rollBack();
    }

    $mensaje = "ROLLBACK ejecutado: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transacciones PDO</title>
</head>
<body>

<h2>Registro de alumno</h2>

<form method="POST">
    Nombre: <input type="text" name="nombre" required><br><br>
    Correo: <input type="email" name="correo" required><br><br>

    Simular error: <input type="checkbox" name="error"><br><br>

    <button type="submit">Registrar alumno</button>
</form>

<p><?php echo $mensaje; ?></p>

</body>
</html>