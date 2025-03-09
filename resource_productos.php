<html lang="ca">

<head>
    <title>Productos</title>
    <style>
        .productos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .producto-card {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .producto-imagen {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<header>
    HEADER
</header>

<body>
    <?php 
    require_once __DIR__ . '/controller/productos_controller.php';
    ?>
</body>

<footer>

</footer>

</html>