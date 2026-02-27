# Práctica 4 – POO + Herencia + Excepciones

## Objetivo
Desarrollar un mini sistema en PHP aplicando Programación Orientada a Objetos,
incluyendo encapsulamiento, herencia, polimorfismo, validación de datos y
manejo de excepciones.

## Tecnologías utilizadas
- PHP 8+
- XAMPP
- HTML
- Git y GitHub

## Estructura del proyecto
parcial-1-poo/practica-4/
├── clases/
│   ├── Usuario.php
│   ├── Admin.php
│   ├── Alumno.php
│   └── Invitado.php
├── index.php
└── README.md

## Funcionalidad
- Se crea una clase base Usuario con validación de correo.
- Se implementan las clases hijas Admin, Alumno e Invitado.
- Se usa herencia y polimorfismo con el método getRol().
- Se maneja una excepción con try/catch para un correo inválido.
- Se muestra una tabla HTML con los usuarios válidos.

## Ejecución
Abrir en el navegador:
http://localhost/desarrollo-web-avanzado-fimaz-uas/parcial-1-poo/practica-4/

## Evidencia esperada
- Tabla con usuarios
- Mensaje de error controlado