<header class="bg-dark text-white py-3 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <h1 class="h3 mb-0">Tienda Deportiva</h1>
            </div>
            <div class="col-md-8">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/PaginaWeb_BU/resource_productos.php">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> Carrito</a>
                            </li>
                            <li class="nav-item dropdown">
                                <button class="btn btn-link nav-link dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    <?php if(!isset($_SESSION['user_id'])): ?>
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
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header> 