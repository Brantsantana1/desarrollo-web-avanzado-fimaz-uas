<?php
require_once "Admin.php";

$admin = new Admin("Brant Santana", "Brantsantana1@gmail.com");

echo "<h2>Datos del Admin</h2>";
echo "Nombre: " . $admin->getNombre() . "<br>";
echo "Correo: " . $admin->getCorreo() . "<br>";
echo "Rol: " . $admin->getRol();