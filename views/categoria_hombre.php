<!-- Página de categoría Hombre -->
<div class="container-fluid px-0">
    <!-- Slider principal -->
    <div id="carouselCategoriaHombre" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($sliderImagenes as $index => $imagen): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <img src="<?= $imagen ?>" class="d-block w-100" alt="Moda hombre">
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategoriaHombre" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselCategoriaHombre" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <!-- Subcategorías -->
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Categorías</h2>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="h4 fw-normal">Descubre todas nuestras subcategorías</div>
                    <a href="/PaginaWeb_BU/resource_productos.php?categoria=hombre" class="text-decoration-none text-dark">Ver Todo</a>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <?php foreach ($subcategoriasMostrar as $subcategoria): ?>
                <div class="col-md-4 mb-4">
                    <a href="<?= $subcategoria['enlace'] ?>" class="text-decoration-none">
                        <div class="card border-0 rounded-0 h-100">
                            <img src="<?= $subcategoria['imagen'] ?>" class="card-img-top rounded-0" alt="<?= $subcategoria['nombre'] ?>" style="object-fit: cover; height: 300px;">
                            <div class="card-body text-center">
                                <h5 class="card-title text-dark"><?= $subcategoria['nombre'] ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Productos destacados -->
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Selección Top</h2>
            </div>
        </div>

        <div class="row">
            <?php if (empty($productos_destacados)): ?>
                <div class="col-12 text-center">
                    <p>No hay productos destacados disponibles en este momento.</p>
                </div>
            <?php else: ?>
                <?php foreach ($productos_destacados as $producto): ?>
                    <div class="col-md-3 mb-4">
                        <a href="/PaginaWeb_BU/resource_detalle_producto.php?id=<?= $producto['id_producto'] ?>" class="text-decoration-none">
                            <div class="card border-0 rounded-0 h-100">
                                <img src="/PaginaWeb_BU/public/<?= $producto['url_imagen'] ?? 'imagenes/productos/no-image.jpg' ?>" class="card-img-top rounded-0" alt="<?= $producto['nombre_producto'] ?>" style="object-fit: cover; height: 250px;">
                                <div class="card-body px-0">
                                    <p class="card-text mb-1"><?= number_format($producto['precio'], 2) ?>€</p>
                                    <h5 class="card-title text-dark"><?= $producto['nombre_producto'] ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Scripts necesarios -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = new bootstrap.Carousel(document.querySelector('#carouselCategoriaHombre'), {
            interval: 5000
        });
    });
</script> 