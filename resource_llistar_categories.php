<?php
// RECURSO PARA LISTAR CATEGORÍAS

// Definir el título de la página
$pageTitle = 'Categorías - Tienda Deportiva';

// Iniciar el buffer de salida
ob_start();

// Incluir el controlador
require_once __DIR__ . '/controller/llistar_categories.php';

// Obtener el contenido del buffer
$content = ob_get_clean();

// Incluir el layout principal
require_once __DIR__ . '/views/layouts/main.php';
?>