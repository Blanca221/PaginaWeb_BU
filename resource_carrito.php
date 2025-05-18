<?php
// RECURSO PARA EL CARRITO DE COMPRAS

$pageTitle = 'Carrito de Compras - Tienda Deportiva';

// Iniciar el buffer de salida
ob_start();

// Incluir el controlador del carrito
require_once __DIR__ . '/controller/carrito_controller.php';

// Obtener el contenido del buffer
$content = ob_get_clean();

// Incluir el layout principal
require_once __DIR__ . '/views/layouts/main.php';
?>
