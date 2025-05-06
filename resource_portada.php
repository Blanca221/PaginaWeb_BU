<?php
// RECURSO PRINCIPAL - PÁGINA DE INICIO DE LA TIENDA

$pageTitle = 'Inicio - Tienda Deportiva';

// Iniciar el buffer de salida
ob_start();

// Incluir el controlador de la portada
require_once __DIR__ . '/controller/mostrar_portada.php';

// Obtener el contenido del buffer
$content = ob_get_clean();

// Incluir el layout principal
require_once __DIR__ . '/views/layouts/main.php';
?>