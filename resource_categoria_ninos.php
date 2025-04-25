<?php
// RECURSO PARA LA CATEGORÍA NIÑOS - PATRÓN MVC

// Definir el título de la página
$pageTitle = 'Moda Infantil - Tienda Deportiva';

// Iniciar el buffer de salida
ob_start();

// Incluir el controlador
require_once __DIR__ . '/controller/mostrar_categoria_ninos.php';

// Obtener el contenido del buffer
$content = ob_get_clean();

// Incluir el layout principal
require_once __DIR__ . '/views/layouts/main.php';
?> 