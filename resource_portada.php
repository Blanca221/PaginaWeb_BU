/**
 * Página principal de la aplicación
 * 
 * Esta página muestra la portada del sitio web, incluyendo:
 * - Enlaces a otras secciones
 * - Mensaje de bienvenida
 * - Integración con el controlador de mensajes
 */

<html lang="ca">

<head>
    <title>Portada - TDIW</title>
</head>

<body>

    <div class="container">
        Este es nuestro pagina de inicio <br>
    </div>
    <!--1.Modifica el "resource_portada", agrega un link para ir al resource "resource_llistar_categories"-->
    <a href="?action=llistar-categories">Ir a listar categorias</a>
     <!--2.Mofifica el "resource_portada", agrega el mensaje con el id 1 de la tabla MENSAJES.-->
    <?php require __DIR__ . '/controller/llistar_mensaje.php'; ?>

</body>

</html 