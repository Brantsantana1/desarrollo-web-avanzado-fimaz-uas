<?php
require_once "Usuario.php";

// Crear un objeto de la clase Usuario
$usuario = new Usuario("Brant", "Brantsantana1@gmail.com");

// Mostrar los datos usando los getters
echo "<h1>Datos del usuario</h1>";
echo "Nombre: " . $usuario->getNombre() . "<br>";
echo "Correo: " . $usuario->getCorreo();
