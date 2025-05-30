<?php
/**
 * CONTROLADOR: CATEGORÍA NIÑOS
 * Gestiona la visualización de subcategorías y productos destacados para niños
 */

require_once __DIR__ . '/../model/connectaDB.php';
require_once __DIR__ . '/../model/categorias.php';
require_once __DIR__ . '/../model/productos.php';

// CONEXIÓN A BASE DE DATOS
$conection = DB::getInstance();

// OBTENER SUBCATEGORÍAS DE NIÑOS
$subcategorias = obtenerSubcategoriasNinos($conection);

// OBTENER PRODUCTOS DESTACADOS
$productos_destacados = obtenerProductosDestacadosPorCategoria($conection, 'nino', 4);

// OBTENER BANNERS
$banners = obtenerBannersNinos($conection);
$sliderImagenes = [];

// PROCESAR BANNERS
if (!empty($banners)) {
    foreach ($banners as $banner) {
        $sliderImagenes[] = '/PaginaWeb_BU/public/' . $banner['url_imagen'];
    }
}

// PROCESAR SUBCATEGORÍAS
$subcategoriasMostrar = [];
if (!empty($subcategorias)) {
    foreach ($subcategorias as $subcat) {
        // Verificar imagen
        $imagen = !empty($subcat['imagen_url']) ? 
                '/PaginaWeb_BU/public/' . $subcat['imagen_url'] : 
                '/PaginaWeb_BU/public/imagenes/no-image.jpg';
        
        // Determinar tipo de categoría
        $tipoCategoria = '';
        if (strpos(strtolower($subcat['nombre_cat']), 'ropa') !== false) {
            $tipoCategoria = 'ropa';
        } elseif (strpos(strtolower($subcat['nombre_cat']), 'calzado') !== false) {
            $tipoCategoria = 'calzado';
        } else {
            $tipoCategoria = 'accesorios';
        }
        
        // Agregar a lista
        $subcategoriasMostrar[] = [
            'nombre' => $subcat['nombre_cat'],
            'imagen' => $imagen,
            'enlace' => '/PaginaWeb_BU/resource_productos.php?categoria=' . $tipoCategoria . '&genero=ninos'
        ];
    }
}

// CARGAR VISTA
include __DIR__ . '/../views/categoria_ninos.php';
?> 