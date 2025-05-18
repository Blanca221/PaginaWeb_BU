<?php
// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Variable para almacenar mensajes de error
$error_message = $_SESSION['login_error'] ?? '';

// Limpiar el mensaje de error después de mostrarlo
if (isset($_SESSION['login_error'])) {
    unset($_SESSION['login_error']);
}
?>

<!--Ejercicio [11]
    Crea una pagina para iniciar sesion y que sea funcional. Tienes que comprobar si el usuario y la password corresponde con las
        que hayas creado anteriormente.
-->

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Iniciar Sesión - Tienda Deportiva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Iniciar Sesión</h2>
                        
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger mb-3" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>
                        <form action="?action=inicio-session" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nombre de usuario</label>
                                <input type="text" class="form-control" id="username" name="username" maxlength="20" minlength="4" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mb-3 text-end">
                                <a href="?action=Pagina-restablecerPassword" class="text-decoration-none">¿Has olvidado tu contraseña?</a>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                            </div>
                        </form>
                        
                        <div class="text-center mt-4">
                            <p>¿No tienes cuenta? <a href="?action=pagina-registro" class="text-decoration-none">Regístrate</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>