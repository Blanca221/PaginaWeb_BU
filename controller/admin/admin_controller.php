<?php
require_once __DIR__ . '/../../model/usuarios.php';
require_once __DIR__ . '/../../model/productos.php';
require_once __DIR__ . '/../../model/connectaDB.php';

// Verificar si es administrador
if (!esAdmin()) {
    header('Location: index.php');
    exit();
}

$conection = DB::getInstance();

// Subacciones del panel de administración
$subaction = $_GET['subaction'] ?? 'dashboard';

switch ($subaction) {
    case 'crear-producto':
        include __DIR__ . '/productos_controller.php';
        break;
    case 'editar-producto':
        include __DIR__ . '/productos_controller.php';
        break;
    case 'eliminar-producto':
        include __DIR__ . '/productos_controller.php';
        break;
    default:
        // Dashboard principal
        include __DIR__ . '/../../views/admin/panel.php';
        break;
}
?> 