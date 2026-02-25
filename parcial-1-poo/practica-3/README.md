# Práctica 3 – Sistema de Usuarios con Validaciones y Excepciones

## Descripción
En esta práctica se desarrolló un sistema de usuarios utilizando Programación Orientada a Objetos en PHP.  
Se implementa herencia entre clases, validación de datos y manejo de excepciones para simular un entorno profesional.

## Estructura del proyecto
practica-3/
│── clases/
│   ├── Usuario.php
│   ├── Admin.php
│   └── Alumno.php
│── index.php
│── README.md

## Descripción de las clases

### Usuario
Clase base que contiene los atributos:
- nombre
- correo

Valida el formato del correo utilizando filter_var.  
Si el correo es inválido, lanza una excepción con throw new Exception.

### Admin
Hereda de la clase Usuario y sobrescribe el método getRol() para retornar "Administrador".

### Alumno
Hereda de la clase Usuario.  
Agrega el atributo matrícula y sobrescribe el método getRol() para retornar "Alumno".

## Manejo de excepciones
En el archivo index.php se implementa un bloque try/catch donde:
- Se crean usuarios válidos (Admin y Alumno)
- Se intenta crear un usuario con un correo inválido
- La excepción es capturada y se muestra un mensaje de error controlado

## Resultado esperado
El sistema muestra:
- Datos de usuarios válidos
- Mensaje de error cuando el correo no tiene un formato correcto

Esto demuestra el uso correcto de herencia, validaciones y manejo de excepciones en PHP.