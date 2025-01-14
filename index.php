<?php
// index.php
session_start();

$action = $_GET['action'] ?? null;

switch ($action) {

    // Resources
    case 'pagina-login'://1
        include __DIR__.'/resource_llistar_categories.php';
        break;
    case 'pagina-registre'://1
         include __DIR__.'/resource_registre.php';
         break;
    case 'pagina-inicio'://2
        include __DIR__.'/resource_portada.php';
        break;
    case 'Pagina-producto'://3
        include __DIR__.'/resource_llistar_categories.php';
        break;
    case 'Pagina-administracion'://4
        include __DIR__.'/resource_llistar_categories.php';
            break;
    case 'Pagina-restablecerContraseña'://5
        include __DIR__.'/resource_llistar_categories.php';
            break;            
    // Default
    default:
        include __DIR__.'/resource_portada.php';//Pagina de portada
        break;
}

?>