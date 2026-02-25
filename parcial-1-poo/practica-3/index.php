<?php
require_once "clases/Admin.php";
require_once "clases/Alumno.php";

echo "<h2>Prueba de usuarios</h2>";

try {
    // Usuario válido Admin
    $admin = new Admin("Carlos", "carlos@correo.com");
    echo "Nombre: " . $admin->getNombre() . "<br>";
    echo "Correo: " . $admin->getCorreo() . "<br>";
    echo "Rol: " . $admin->getRol() . "<br><br>";

    // Usuario válido Alumno
    $alumno = new Alumno("Ana", "ana@correo.com", "20231234");
    echo "Nombre: " . $alumno->getNombre() . "<br>";
    echo "Correo: " . $alumno->getCorreo() . "<br>";
    echo "Matrícula: " . $alumno->getMatricula() . "<br>";
    echo "Rol: " . $alumno->getRol() . "<br><br>";

    // Usuario con correo inválido (provoca excepción)
    $usuarioError = new Usuario("Pedro", "correo-invalido");

} catch (Exception $e) {
    echo "<strong>Error:</strong> " . $e->getMessage();
}