<?php
// index.php
session_start();

// CONTROLADOR PRINCIPAL - ROUTER DE LA APLICACIÓN
$action = $_GET['action'] ?? null;

switch ($action) {
    // MÓDULO DE AUTENTICACIÓN
    case 'pagina-login':
        include __DIR__.'/resource_iniciar_sesion.php';
        break;
    case 'pagina-registro':
        include __DIR__.'/resource_registre.php';
        break;
    case 'cerrar-sesion':
        require_once __DIR__ . '/model/usuarios.php';
        cerrarSesion();
        break;
    case 'obtener-pregunta':
        include __DIR__.'/controller/obtener_pregunta.php';
        break;
    case 'verificar-seguridad':
        include __DIR__.'/controller/verificar_seguridad.php';
        break;
    case 'cambiar-password':
        include __DIR__.'/controller/cambiar_password.php';
        break;
    case 'registre-session':
        include __DIR__.'/controller/almacenar_registro.php';
        break;
    case 'check-email':
        include __DIR__.'/controller/check_email.php';
        break;
    case 'inicio-session':
        include __DIR__.'/controller/iniciar_sesion.php';
        break;
    case 'Pagina-restablecerPassword':
        include __DIR__.'/resource_restablecer_password.php';
        break;
    
    // MÓDULO DE PRODUCTOS Y CATEGORÍAS
    case 'pagina-productos':
        include __DIR__.'/resource_productos.php';
        break;
    case 'llistar-categories':
        include __DIR__.'/resource_llistar_categories.php';
        break;
    case 'categoria-hombre':
        include __DIR__.'/resource_categoria_hombre.php';
        break;
    case 'categoria-mujer':
        include __DIR__.'/resource_categoria_mujer.php';
        break;
    case 'categoria-ninos':
        include __DIR__.'/resource_categoria_ninos.php';
        break;
    case 'detalle-producto':
        include __DIR__.'/resource_detalle_producto.php';
        break;

    // MÓDULO DE ADMINISTRACIÓN
    case 'Pagina-administracion':
        // Verificar si el usuario es administrador
        require_once __DIR__ . '/model/usuarios.php';
        if (!estaLogueado() || !esAdmin()) {
            header("Location: index.php?action=pagina-login");
            exit();
        }
        include __DIR__.'/resource_administracion.php';
        break;

    // MÓDULO DE PERFIL
    case 'perfil':
        include __DIR__ . '/resource_perfil.php';
        break;

    // PORTADA (DEFAULT)
    default:
        include __DIR__.'/resource_portada.php';
        break;
}
?>