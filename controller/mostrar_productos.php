<!--[10] (M) Crea una pagina (resource, MVC) que muestre los productos por categoria, pasando por parametro "get" la categoria que queremos mostrar.
        La consulta tambien tiene que ser parametrizada. Si no se indica la categoria en la url muestra la categoria 1 por defecto.-->
<?php

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/productos.php';

$conection = DB::getInstance();

$categoria = $_GET['categoria'] ?? 1;

$productos = getProductsByCategory($conection, $categoria);

include __DIR__ . '/../views/llistar_productos.php';

?>