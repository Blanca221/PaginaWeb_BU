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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .login-container {
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: stretch;
            max-width: 1800px;
            margin: 0 auto;
            padding: 2rem;
        }
        .login-form-container {
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            padding: 3rem;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            margin-right: 2rem;
        }
        .login-form {
            width: 100%;
            max-width: 500px;
            padding: 2rem;
        }
        .login-image-container {
            background: linear-gradient(135deg, #2c2c2c 0%, #1a1a1a 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            flex: 1;
            overflow: hidden;
            border-radius: 20px;
        }
        .login-image-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/PaginaWeb_BU/public/imagenes/home/pattern.png');
            background-size: cover;
            opacity: 0.1;
            z-index: 1;
        }
        .login-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.2);
            z-index: 2;
        }
        .login-image-text {
            position: relative;
            z-index: 3;
            padding: 2rem;
            max-width: 90%;
        }
        .login-form-container {
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            padding: 2rem;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1);
        }
        .login-form {
            width: 100%;
            max-width: 450px;
            padding: 2rem;
        }
        .form-control {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(106, 17, 203, 0.15);
            border-color: #6a11cb;
            background-color: #fff;
        }
        .btn-primary {
            background: linear-gradient(135deg, #333333 0%, #1a1a1a 100%);
            border: none;
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #404040 0%, #262626 100%);
        }
        .login-title {
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 2.5rem;
            font-size: 2.4rem;
        }
        .form-label {
            font-weight: 500;
            color: #404040;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
            color: #404040;
            padding: 0.75rem 1rem;
        }
        .input-group .form-control {
            border-left: none;
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }
        .login-link {
            color: #404040;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border-bottom: 1px solid transparent;
        }
        .login-link:hover {
            color: #1a1a1a;
            border-bottom-color: #1a1a1a;
            text-decoration: none;
        }
        .product-image {
            max-width: 80%;
            margin: 1.5rem auto;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.5s ease;
        }
        .product-image:hover {
            transform: scale(1.05);
        }
        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        .welcome-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        @media (max-width: 991.98px) {
            .login-container {
                flex-direction: column;
                height: auto;
            }
            .login-image-container {
                min-height: 40vh;
            }
            .login-form-container {
                padding: 2rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Columna de imagen y mensaje -->
        <div class="login-image-container">
            <div class="login-image-overlay"></div>
            <div class="login-image-text">
                <h1 class="welcome-title">Bienvenido de nuevo</h1>
                <p class="welcome-subtitle">Accede a tu cuenta para descubrir las últimas novedades en moda deportiva</p>
                <img src="/PaginaWeb_BU/public/imagenes/home/inicio registro.png" alt="Deportes" class="img-fluid product-image">
            </div>
        </div>
        
        <!-- Columna del formulario -->
        <div class="login-form-container">
            <div class="login-form">
                <h2 class="login-title">Iniciar Sesión</h2>
                
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger mb-4" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                
                <form action="?action=inicio-session" method="post">
                    <div class="mb-4">
                        <label for="username" class="form-label">Nombre de usuario</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="username" name="username" maxlength="20" minlength="4" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>

                    <div class="mb-4 text-end">
                        <a href="?action=Pagina-restablecerPassword" class="login-link">¿Has olvidado tu contraseña?</a>
                    </div>
                    
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-primary btn-lg">Iniciar Sesión</button>
                    </div>
                    
                    <div class="text-center">
                        <p>¿No tienes cuenta? <a href="?action=pagina-registro" class="login-link">Regístrate ahora</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>