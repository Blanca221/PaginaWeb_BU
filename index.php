<?php
// index.php
session_start();

$action = $_GET['action'] ?? null;

switch ($action) {
    
    // Resources
    //pagina de login
    case 'pagina-login':
        include __DIR__.'/resource_iniciar_sesion.php';
        break;
    //pagina de  registro
    case 'pagina-registre':
         include __DIR__.'/resource_registre.php';
         break;
    //pagina de producto
    case 'Pagina-producto':
        include __DIR__.'/resource_productos.php';
        break;

    case 'pagina-productos':
        include __DIR__.'/resource_productos.php';
        break;
        
    //NO lo e hecho aun
    case 'Pagina-administracion':
        include __DIR__.'/resource_administracion.php';
            break;
    //resource para restablecer la contraseña y los controladores
    case 'Pagina-restablecerPassword':
        include __DIR__.'/resource_restablecer_password.php';
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
    
    //Esta relacionada con la ruta registre
    case 'registre-session':
        include __DIR__.'/controller/almacenar_registro.php';
        break;
    //Esta ruta al controlador revisa el mail que no este en uso
    case 'check-email':
        include __DIR__.'/controller/check_email.php';
         break;
    //Este relacionada con la ruta inicio-sesion
    case 'inicio-session':
        include __DIR__.'/controller/iniciar_sesion.php';
        break;
    /*
     // Resources
    case 'llistar-categories':
        include __DIR__.'/resource_llistar_categories.php';
        break;
    //pagina de registro
    case 'registre':
        include __DIR__.'/resource_registre.php';
        break;
    //pagina para listar productos
    case 'llistar-productes':
        include __DIR__.'/resource_productos.php';
        break;
    //iniciar sesion
    case 'inicio-sesion':
        include __DIR__.'/resource_iniciar_sesion.php';
        break;
        //ESTAS DOS NO NECESITAN VIEW PORQUE NO SON PAGINAS SINO ACCIONES -> SON LOS CONTROLADORES 

    //Esta relacionada con la ruta registre
    case 'registre-session':
        include __DIR__.'/controller/almacenar_registro.php';
        break;
    //Este relacionada con la ruta inicio-sesion
    case 'inicio-session':
        include __DIR__.'/controller/iniciar_sesion.php';
        break;

    case 'ejemplo':
        include __DIR__.'/resource_ejemplo.php';
        break;
    
    */

    // Default
    default:
        include __DIR__.'/resource_portada.php';
        break;
}

?>