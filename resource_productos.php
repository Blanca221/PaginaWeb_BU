<?php
// Definir el título de la página
$pageTitle = 'Productos - Tienda Deportiva';

// Iniciar el buffer de salida
ob_start();

// Incluir el controlador
require_once __DIR__ . '/controller/mostrar_productos.php';

// Obtener el contenido del buffer
$content = ob_get_clean();

// Incluir el layout principal
require_once __DIR__ . '/views/layouts/main.php';
?>