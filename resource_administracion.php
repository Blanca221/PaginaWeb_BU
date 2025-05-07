<?php
// PANEL DE ADMINISTRACIÓN - ACCESO RESTRINGIDO A ADMINISTRADORES

// Cargar dependencias
require_once __DIR__ . '/model/connectaDB.php';
require_once __DIR__ . '/model/usuarios.php';
// require_once __DIR__ . '/controller/admin/admin_controller.php'; // Eliminada para evitar doble inclusión

// VERIFICACIÓN DE PERMISOS
if (!estaLogueado() || !esAdmin()) {
    header("Location: index.php?action=pagina-login");
    exit();
}

// Definir el título de la página
$pageTitle = 'Panel de Administración - Tienda Deportiva';

// Iniciar el buffer de salida
ob_start();

// ROUTING INTERNO DE ADMINISTRACIÓN
$subaction = $_GET['subaction'] ?? 'dashboard';

switch ($subaction) {
    case 'crear-producto':
    case 'editar-producto':
    case 'eliminar-producto':
    case 'listar-productos':
        include __DIR__ . '/controller/admin/productos_controller.php';
        break;
    default:
        include __DIR__ . '/controller/admin/admin_controller.php';
        break;
}

// Obtener el contenido del buffer
$content = ob_get_clean();

// Si hay contenido en el buffer, mostrarlo
if ($content) {
    echo $content;
} else {
    // Si no hay contenido, mostrar el panel por defecto
    include __DIR__ . '/views/admin/panel.php';
}
?> 