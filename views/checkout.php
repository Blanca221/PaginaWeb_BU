<?php
// Vaciar el carrito al confirmar el pedido
require_once __DIR__ . '/../model/connectaDB.php';
require_once __DIR__ . '/../model/carrito.php';

// Verificar si el usuario está logueado
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $id_cliente = $_SESSION['id_cliente'];
    $conection = DB::getInstance();
    
    // Obtener el número de productos antes de vaciar
    $num_productos = contarProductosCarrito($conection, $id_cliente);
    
    // Vaciar el carrito
    $resultado = vaciarCarrito($conection, $id_cliente);
}
?>

<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow p-5">
                <!-- Animación simple de check -->
                <div class="success-animation mb-4">
                    <div class="success-circle">
                        <div class="success-tick"></div>
                    </div>
                </div>
                
                <h1 class="display-4 text-success mb-4">¡Pedido Realizado!</h1>
                <p class="lead mb-4">Gracias por tu compra. Tu pedido ha sido procesado correctamente.</p>
                
                <div class="mt-5">
                    <a href="index.php" class="btn btn-primary btn-lg">
                        Volver a la Tienda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Animación simple de check */
.success-animation {
    margin: 20px auto;
    width: 80px;
    height: 80px;
}

.success-circle {
    width: 80px;
    height: 80px;
    background-color: #4BB543;
    border-radius: 50%;
    position: relative;
    animation: scale 0.5s ease-in-out;
}

.success-tick {
    position: absolute;
    top: 25px;
    left: 25px;
    width: 30px;
    height: 15px;
    border-left: 5px solid white;
    border-bottom: 5px solid white;
    transform: rotate(-45deg);
    animation: tick 0.5s ease-in-out 0.3s forwards;
    opacity: 0;
}

@keyframes scale {
    0% {
        transform: scale(0);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes tick {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

/* Redirigir a la página principal después de 5 segundos */
</style>

<script>
// Redirigir a la página principal después de 5 segundos
setTimeout(function() {
    window.location.href = 'index.php';
}, 5000);
</script>
