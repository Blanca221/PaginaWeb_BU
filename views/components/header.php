<header>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                <a href="/PaginaWeb_BU/" class="text-decoration-none">
                    <h1 class="h3 mb-0 fw-bold">SPORTS STORE</h1>
                </a>
            </div>
            <div class="col-md-6">
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/PaginaWeb_BU/index.php?action=categoria-hombre">HOMBRE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/PaginaWeb_BU/index.php?action=categoria-mujer">MUJER</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/PaginaWeb_BU/index.php?action=categoria-ninos">NIÑOS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/PaginaWeb_BU/resource_productos.php?categoria=ofertas">OFERTAS</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-md-3">
                <div class="user-options">
                    <form class="search-form" action="/PaginaWeb_BU/resource_productos.php" method="GET">
                        <input type="text" class="search-input" placeholder="Buscar productos..." name="buscar">
                        <button class="search-btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    <div class="dropdown">
                        <button class="btn btn-link p-0" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <?php if(!isset($_SESSION['loggedin'])): ?>
                                <li><a class="dropdown-item" href="/PaginaWeb_BU/index.php?action=pagina-registro">Registrarse</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/PaginaWeb_BU/index.php?action=pagina-login">Iniciar Sesión</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="#">Mi Perfil</a></li>
                                <li><a class="dropdown-item" href="#">Mis Pedidos</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/PaginaWeb_BU/index.php?action=cerrar-sesion">Cerrar Sesión</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <a href="#" class="position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill">
                                <?php echo count($_SESSION['cart']); ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Enlaces a CSS y JS necesarios -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> 