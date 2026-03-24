<?php

spl_autoload_register(function ($class) {
    $ruta = str_replace("\\", "/", $class) . ".php";
    require_once __DIR__ . "/../" . $ruta;
});