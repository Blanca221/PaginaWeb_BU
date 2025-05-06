<!-- Hero Section con Carrusel -->
<section class="hero-section position-relative">
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
                    <div class="hero-slide">
                        <img src="<?php echo htmlspecialchars($hero['url_imagen_completa']); ?>" 
                             alt="<?php echo htmlspecialchars($hero['titulo']); ?>">
                        <div class="carousel-caption">
                            <h1 class="hero-title"><?php echo htmlspecialchars($hero['titulo']); ?></h1>
                            <p class="hero-subtitle"><?php echo htmlspecialchars($hero['subtitulo']); ?></p>
                            <a href="<?php echo htmlspecialchars($hero['url_enlace']); ?>" class="btn hero-btn">
                                COMPRAR AHORA
                            </a>
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