<!-- Hero Section con Carrusel -->
<section class="hero-section position-relative">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-current="false" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-current="false" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="hero-slide">
                    <img src="/PaginaWeb_BU/public/imagenes/home/hero-principal1.png" alt="Imagen Principal 1">
                    <div class="carousel-caption">
                        <h1 class="hero-title">Colección Deportiva</h1>
                        <p class="hero-subtitle">Descubre nuestras novedades</p>
                        <a href="/PaginaWeb_BU/index.php?action=ofertas" class="btn hero-btn">
                            COMPRAR AHORA
                        </a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="hero-slide">
                    <img src="/PaginaWeb_BU/public/imagenes/home/hero-principal2.png" alt="Imagen Principal 2">
                    <div class="carousel-caption">
                        <h1 class="hero-title">Rendimiento Deportivo</h1>
                        <p class="hero-subtitle">Equipamiento de alta calidad</p>
                        <a href="/PaginaWeb_BU/index.php?action=ofertas" class="btn hero-btn">
                            COMPRAR AHORA
                        </a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="hero-slide">
                    <img src="/PaginaWeb_BU/public/imagenes/home/hero-principal3.png" alt="Imagen Principal 3">
                    <div class="carousel-caption">
                        <h1 class="hero-title">Estilo y Confort</h1>
                        <p class="hero-subtitle">Para todos los deportes</p>
                        <a href="/PaginaWeb_BU/index.php?action=ofertas" class="btn hero-btn">
                            COMPRAR AHORA
                        </a>
                    </div>
                </div>
            </div>
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
<section id="categorias" class="categories-section">
    <div class="container-fluid">
        <div class="section-title-container">
            <h2 class="section-title">CATEGORÍAS DESTACADAS</h2>
        </div>
        <div class="row">
            <!-- Hombre -->
            <div class="col-md-4">
                <div class="category-card category-hombre">
                    <img src="/PaginaWeb_BU/public/imagenes/home/cat hombre.webp" 
                         alt="Categoría Hombre">
                    <div class="overlay position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center">
                        <div class="text-center text-white">
                            <h3 class="category-title">HOMBRE</h3>
                            <p class="category-subtitle">Encuentra tu estilo deportivo</p>
                            <a href="/PaginaWeb_BU/index.php?action=categoria-hombre" class="btn category-btn">
                                Ver colección
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mujer -->
            <div class="col-md-4">
                <div class="category-card category-mujer">
                    <img src="/PaginaWeb_BU/public/imagenes/home/cat mujer.webp" 
                         alt="Categoría Mujer">
                    <div class="overlay position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center">
                        <div class="text-center text-white">
                            <h3 class="category-title">MUJER</h3>
                            <p class="category-subtitle">Diseño y rendimiento</p>
                            <a href="/PaginaWeb_BU/index.php?action=categoria-mujer" class="btn category-btn">
                                Ver colección
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Niños -->
            <div class="col-md-4">
                <div class="category-card category-ninos">
                    <img src="/PaginaWeb_BU/public/imagenes/home/cat niños.webp" 
                         alt="Categoría Niños">
                    <div class="overlay position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center">
                        <div class="text-center text-white">
                            <h3 class="category-title">NIÑOS</h3>
                            <p class="category-subtitle">Deporte y diversión</p>
                            <a href="/PaginaWeb_BU/index.php?action=categoria-ninos" class="btn category-btn">
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
<section class="featured-products">
    <div class="container-fluid">
        <div class="section-title-container">
            <h2 class="section-title">PRODUCTOS DESTACADOS</h2>
        </div>
        <div class="row">
            <?php foreach ($productos_destacados as $producto): ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="/PaginaWeb_BU/index.php?action=detalle-producto&id=<?php echo $producto['id_producto']; ?>" class="text-decoration-none">
                    <div class="product-card">
                        <div class="product-img-container">
                            <?php if(isset($producto['es_nuevo']) && $producto['es_nuevo']): ?>
                                <span class="badge">NUEVO</span>
                            <?php endif; ?>
                            <img src="<?php echo htmlspecialchars($producto['url_imagen'] ?? ''); ?>" 
                                alt="<?php echo htmlspecialchars($producto['nombre'] ?? 'Producto'); ?>" 
                                class="product-img">
                        </div>
                        <div class="product-info">
                            <div>
                                <h5 class="product-title"><?php echo htmlspecialchars($producto['nombre'] ?? 'Producto sin nombre'); ?></h5>
                                <p class="product-brand"><?php echo htmlspecialchars($producto['marca'] ?? ''); ?></p>
                            </div>
                            <p class="product-price">€<?php echo number_format($producto['precio'] ?? 0, 2); ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>