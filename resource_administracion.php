<?php
// PANEL DE ADMINISTRACIÓN - ACCESO RESTRINGIDO A ADMINISTRADORES

// Cargar dependencias
require_once __DIR__ . '/model/connectaDB.php';
require_once __DIR__ . '/model/usuarios.php';

// VERIFICACIÓN DE PERMISOS
if (!estaLogueado() || !esAdmin()) {
    header("Location: ?action=pagina-login");
    exit();
}

// Definir el título de la página
$pageTitle = 'Panel de Administración - Tienda Deportiva';

// Iniciar el buffer de salida
ob_start();

// ROUTING INTERNO DE ADMINISTRACIÓN
$adminAction = $_GET['admin_action'] ?? 'dashboard';

switch ($adminAction) {
    case 'productos':
        include __DIR__ . '/views/admin/productos.php';
        break;
    case 'usuarios':
        include __DIR__ . '/views/admin/usuarios.php';
        break;
    case 'categorias':
        include __DIR__ . '/views/admin/categorias.php';
        break;
    case 'pedidos':
        include __DIR__ . '/views/admin/pedidos.php';
        break;
    case 'home_content':
        include __DIR__ . '/views/admin/home_content.php';
        break;
    default:
        include __DIR__ . '/views/admin/dashboard.php';
        break;
}

// Obtener el contenido del buffer
$content = ob_get_clean();

// Incluir el layout de administración
require_once __DIR__ . '/views/layouts/admin.php';
?> 