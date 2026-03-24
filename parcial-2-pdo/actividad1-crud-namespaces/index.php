```php
<?php

require_once 'vendor/autoload.php';

use Controllers\ProductoController;
use Models\Producto;

$controller = new ProductoController();

// ELIMINAR
if (isset($_GET['eliminar'])) {
    $controller->eliminar($_GET['eliminar']);
}

// OBTENER PARA EDITAR
$productoEditar = null;

if (isset($_GET['editar'])) {
    $productoEditar = $controller->obtenerPorId($_GET['editar']);
}

// INSERTAR o ACTUALIZAR
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto = new Producto();

    if (!empty($_POST['id'])) {
        $producto->setId($_POST['id']);
    }

    $producto->setNombre($_POST['nombre']);
    $producto->setDescripcion($_POST['descripcion']);
    $producto->setExistencia($_POST['existencia']);
    $producto->setPrecio($_POST['precio']);

    if (!empty($_POST['id'])) {
        $controller->actualizar($producto);
    } else {
        $controller->crear($producto);
    }
}

// LISTAR
$productos = $controller->listar();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Productos</title>
</head>
<body>

<h2><?= $productoEditar ? 'Editar Producto' : 'Agregar Producto' ?></h2>

<form method="POST">

    <input type="hidden" name="id" value="<?= $productoEditar['id'] ?? '' ?>">

    <input type="text" name="nombre" placeholder="Nombre" required 
        value="<?= $productoEditar['nombre'] ?? '' ?>"><br><br>

    <input type="text" name="descripcion" placeholder="Descripción" required 
        value="<?= $productoEditar['descripcion'] ?? '' ?>"><br><br>

    <input type="number" name="existencia" placeholder="Existencia" required 
        value="<?= $productoEditar['existencia'] ?? '' ?>"><br><br>

    <input type="number" step="0.01" name="precio" placeholder="Precio" required 
        value="<?= $productoEditar['precio'] ?? '' ?>"><br><br>

    <button type="submit">
        <?= $productoEditar ? 'Actualizar' : 'Guardar' ?>
    </button>
</form>

<hr>

<h2>Lista de Productos</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Existencia</th>
        <th>Precio</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($productos as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['nombre'] ?></td>
        <td><?= $p['descripcion'] ?></td>
        <td><?= $p['existencia'] ?></td>
        <td><?= $p['precio'] ?></td>
        <td>
            <a href="?editar=<?= $p['id'] ?>">Editar</a> |
            <a href="?eliminar=<?= $p['id'] ?>">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
```
