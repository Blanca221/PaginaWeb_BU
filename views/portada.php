<!-- Hero Carousel - Full Width -->
<div class="hero-fullwidth">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicadores -->
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

        <!-- Slides -->
        <div class="carousel-inner">
            <?php foreach ($heroes as $index => $hero): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="hero-slide">
                        <img src="<?php echo htmlspecialchars($hero['url_imagen_completa']); ?>" 
                             alt="<?php echo htmlspecialchars($hero['titulo']); ?>">
                        <div class="hero-content">
                            <h1><?php echo htmlspecialchars($hero['titulo']); ?></h1>
                            <p><?php echo htmlspecialchars($hero['subtitulo']); ?></p>
                            <a href="<?php echo htmlspecialchars($hero['url_enlace']); ?>" 
                               class="btn btn-light btn-lg">
                                Descubrir más
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Controles -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>

<!-- Banners Section -->
<div class="container mt-5">
    <div class="row g-4">
        <?php foreach ($banners as $banner): ?>
            <div class="col-md-6">
                <div class="banner-card position-relative overflow-hidden rounded shadow">
                    <img src="/PaginaWeb_BU/public/<?php echo htmlspecialchars($banner['url_imagen']); ?>" 
                         class="w-100 h-100 object-fit-cover" 
                         alt="<?php echo htmlspecialchars($banner['titulo']); ?>">
                    
                    <!-- Contenido del banner -->
                    <div class="banner-content position-absolute bottom-0 start-0 w-100 text-white p-4">
                        <h3 class="mb-2"><?php echo htmlspecialchars($banner['titulo']); ?></h3>
                        <p class="mb-3"><?php echo htmlspecialchars($banner['subtitulo']); ?></p>
                        <?php if ($banner['url_enlace']): ?>
                            <a href="<?php echo htmlspecialchars($banner['url_enlace']); ?>" 
                               class="btn btn-light">
                                Ver más
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
/* Solo estilos del Hero */
.hero-fullwidth {
    width: 100vw;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;
    margin-top: -56px; /* Ajustado para compensar la altura del header */
    margin-bottom: 0;
}

.hero-slide {
    height: 100vh;
    position: relative;
    top: 0; /* Asegura que empiece desde arriba */
}

/* Ajuste para el contenedor del carousel */
#heroCarousel {
    margin: 0;
    padding: 0;
}

.carousel-inner {
    margin: 0;
    padding: 0;
}

.hero-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: white;
    width: 80%;
    max-width: 800px;
    background: rgba(0, 0, 0, 0.4);
    padding: 2rem;
    border-radius: 10px;
}

.hero-content h1 {
    font-size: 3.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.hero-content p {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
}
.carousel-indicators button {
    width: 30px;
    height: 3px;
    background-color: rgba(255, 255, 255, 0.5);
    border: none;
    margin: 0 5px;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-slide {
        height: 70vh;
    }

    .hero-content h1 {
        font-size: 2rem;
    }

    .hero-content p {
        font-size: 1.2rem;
    }
}

.banner-card {
    height: 300px;
    transition: transform 0.3s ease;
}

.banner-card:hover {
    transform: scale(1.02);
}

.banner-content {
    background: linear-gradient(
        to top,
        rgba(0,0,0,0.8) 0%,
        rgba(0,0,0,0.4) 60%,
        rgba(0,0,0,0) 100%
    );
}

.banner-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>