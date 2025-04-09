<!-- Hero Section con Carrusel -->
<section class="hero-section position-relative mb-5">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php foreach ($heroes as $index => $hero): ?>
                <button type="button" 
                        data-bs-target="#heroCarousel" 
                        data-bs-slide-to="<?php echo $index; ?>" 
                        class="<?php echo $index === 0 ? 'active' : ''; ?>"
                        aria-current="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                        aria-label="Slide <?php echo $index + 1; ?>">
                </button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
            <?php foreach ($heroes as $index => $hero): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="hero-slide position-relative" style="height: 600px;">
                        <img src="<?php echo htmlspecialchars($hero['url_imagen_completa']); ?>" 
                             class="w-100 h-100 object-fit-cover"
                             alt="<?php echo htmlspecialchars($hero['titulo']); ?>">
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0,0,0,0.4);">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8 text-white">
                                        <h1 class="display-4 fw-bold mb-4"><?php echo htmlspecialchars($hero['titulo']); ?></h1>
                                        <p class="lead mb-4"><?php echo htmlspecialchars($hero['subtitulo']); ?></p>
                                        <a href="<?php echo htmlspecialchars($hero['url_enlace']); ?>" class="btn btn-light btn-lg">
                                            COMPRAR AHORA
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</section>

<!-- Categorías Destacadas -->
<section id="categorias" class="categories-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">CATEGORÍAS DESTACADAS</h2>
        <div class="row g-4">
            <!-- Hombre -->
            <div class="col-md-4">
                <div class="category-card position-relative rounded overflow-hidden" style="height: 650px;">
                    <img src="/PaginaWeb_BU/public/imagenes/home/cat hombre.webp" 
                         alt="Categoría Hombre" 
                         class="w-100 h-100 object-fit-cover">
                    <div class="overlay position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center" 
                         style="background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.7));">
                        <div class="text-center text-white">
                            <h3 class="fw-bold mb-4" style="font-size: 2.5rem;">HOMBRE</h3>
                            <p class="mb-4" style="font-size: 1.2rem;">Encuentra tu estilo deportivo</p>
                            <a href="/PaginaWeb_BU/resource_productos.php?categoria=hombre" class="btn btn-light btn-lg px-5 py-3">
                                Ver colección
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mujer -->
            <div class="col-md-4">
                <div class="category-card position-relative rounded overflow-hidden" style="height: 650px;">
                    <img src="/PaginaWeb_BU/public/imagenes/home/cat mujer.webp" 
                         alt="Categoría Mujer" 
                         class="w-100 h-100 object-fit-cover">
                    <div class="overlay position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center" 
                         style="background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.7));">
                        <div class="text-center text-white">
                            <h3 class="fw-bold mb-4" style="font-size: 2.5rem;">MUJER</h3>
                            <p class="mb-4" style="font-size: 1.2rem;">Diseño y rendimiento</p>
                            <a href="/PaginaWeb_BU/resource_productos.php?categoria=mujer" class="btn btn-light btn-lg px-5 py-3">
                                Ver colección
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Niños -->
            <div class="col-md-4">
                <div class="category-card position-relative rounded overflow-hidden" style="height: 650px;">
                    <img src="/PaginaWeb_BU/public/imagenes/home/cat niños.webp" 
                         alt="Categoría Niños" 
                         class="w-100 h-100 object-fit-cover">
                    <div class="overlay position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center" 
                         style="background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.7));">
                        <div class="text-center text-white">
                            <h3 class="fw-bold mb-4" style="font-size: 2.5rem;">NIÑOS</h3>
                            <p class="mb-4" style="font-size: 1.2rem;">Deporte y diversión</p>
                            <a href="/PaginaWeb_BU/resource_productos.php?categoria=ninos" class="btn btn-light btn-lg px-5 py-3">
                                Ver colección
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Productos Destacados -->
<section class="featured-products py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>PRODUCTOS DESTACADOS</h2>
            <a href="/PaginaWeb_BU/resource_productos.php" class="text-decoration-none text-dark">Ver todos</a>
        </div>
        <div class="row g-4">
            <?php foreach ($productos_destacados as $producto): ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product-card">
                    <div class="position-relative">
                        <?php if($producto['es_nuevo']): ?>
                            <span class="badge bg-dark position-absolute top-0 end-0 m-2">NUEVO</span>
                        <?php endif; ?>
                        <img src="<?php echo htmlspecialchars($producto['url_imagen']); ?>" 
                             alt="<?php echo htmlspecialchars($producto['nombre']); ?>" 
                             class="w-100 mb-3">
                    </div>
                    <h5 class="mb-2"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                    <p class="text-muted small mb-2"><?php echo htmlspecialchars($producto['marca']); ?></p>
                    <p class="fw-bold mb-0">€<?php echo number_format($producto['precio'], 2); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2 class="mb-4">ÚNETE A NUESTRA NEWSLETTER</h2>
                <p class="text-muted mb-4">Suscríbete para recibir las últimas novedades y ofertas exclusivas</p>
                <form class="newsletter-form" action="/PaginaWeb_BU/suscribir-newsletter.php" method="POST">
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" placeholder="Tu email" required>
                        <button class="btn btn-dark" type="submit">Suscribirse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- CSS adicional -->
<style>
.product-card {
    transition: transform 0.3s ease;
}
.product-card:hover {
    transform: translateY(-5px);
}
.category-card {
    transition: transform 0.3s ease;
}
.category-card:hover {
    transform: scale(1.03);
}
.carousel-item img {
    object-fit: cover;
}
.hero-slide {
    background-color: #000;
}
</style>