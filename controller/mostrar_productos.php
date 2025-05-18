<!--[10] (M) Crea una pagina (resource, MVC) que muestre los productos por categoria, pasando por parametro "get" la categoria que queremos mostrar.
        La consulta tambien tiene que ser parametrizada. Si no se indica la categoria en la url muestra la categoria 1 por defecto.-->
<?php
/**
 * Controlador para mostrar productos
 * 
 * Este controlador maneja la visualización de productos en la tienda,
 * incluyendo búsquedas y filtrado por categoría y género.
 */

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/productos.php';
require_once __DIR__ . '/../model/categorias.php';

// Inicializar la conexión a la base de datos
$conection = DB::getInstance();

// Obtener parámetros de la URL con validación
$terminoBusqueda = filter_input(INPUT_GET, 'buscar', FILTER_SANITIZE_STRING) ?: '';
$tipoCategoria = filter_input(INPUT_GET, 'categoria', FILTER_SANITIZE_STRING) ?: '';
$genero = filter_input(INPUT_GET, 'genero', FILTER_SANITIZE_STRING) ?: '';

// Título por defecto para la página
$tituloPagina = 'Todos los productos';

// Si hay un término de búsqueda, determinar qué productos mostrar
if (!empty($terminoBusqueda)) {
    $productos = buscarProductos($conection, $terminoBusqueda);
    $tituloPagina = 'Resultados para: "' . htmlspecialchars($terminoBusqueda) . '"';
} elseif (!empty($tipoCategoria) && !empty($genero)) {
    // Filtrar por tipo de categoría y género
    $id_categoria = 0;
    
    // Determinar el ID de categoría según el tipo y género
    if ($genero == 'hombre') {
        if ($tipoCategoria == 'calzado') {
            $id_categoria = 11; // Calzado de Hombre
        } elseif ($tipoCategoria == 'ropa') {
            $id_categoria = 10; // Ropa de Hombre
        } elseif ($tipoCategoria == 'accesorios') {
            $id_categoria = 12; // Accesorios Hombre
        }
    } elseif ($genero == 'mujer') {
        if ($tipoCategoria == 'calzado') {
            $id_categoria = 14; // Calzado de Mujer
        } elseif ($tipoCategoria == 'ropa') {
            $id_categoria = 13; // Ropa de Mujer
        } elseif ($tipoCategoria == 'accesorios') {
            $id_categoria = 15; // Accesorios Mujer
        }
    } elseif ($genero == 'ninos') {
        if ($tipoCategoria == 'calzado') {
            $id_categoria = 17; // Calzado de Niños
        } elseif ($tipoCategoria == 'ropa') {
            $id_categoria = 16; // Ropa de Niños
        } elseif ($tipoCategoria == 'accesorios') {
            $id_categoria = 18; // Accesorios Niños
        }
    }
    
    if ($id_categoria > 0) {
        $productos = getProductsByCategory($conection, $id_categoria);
        
        // Establecer título según la categoría
        $generoTexto = ($genero == 'hombre') ? 'Hombre' : (($genero == 'mujer') ? 'Mujer' : 'Niños');
        $categoriaTexto = ucfirst($tipoCategoria);
        $tituloPagina = "$categoriaTexto de $generoTexto";
    } else {
        $productos = getAllProducts($conection);
    }
} else {
    // Si no hay búsqueda ni filtros, mostrar todos los productos
    $productos = getAllProducts($conection);
}

include __DIR__ . '/../views/llistar_productos.php';

?>