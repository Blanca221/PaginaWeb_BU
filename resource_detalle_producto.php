<?php
// RECURSO PARA DETALLE DE PRODUCTO - PATRÓN MVC

// Definir el título de la página
$pageTitle = 'Detalle del Producto';

// Iniciar el buffer de salida
ob_start();

// Incluir el controlador
require_once __DIR__ . '/controller/detalle_producto.php';

// Obtener el contenido del buffer
$content = ob_get_clean();

// Incluir el layout principal
require_once __DIR__ . '/views/layouts/main.php';
?> 