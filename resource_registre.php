<?php
// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Variable para almacenar mensajes de error
$error_message = $_SESSION['registro_error'] ?? '';

// Limpiar el mensaje de error después de mostrarlo
if (isset($_SESSION['registro_error'])) {
    unset($_SESSION['registro_error']);
}

// Incluir el controlador de mensajes de registro
require __DIR__ . '/controller/llistar_mensaje_registre.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Crear cuenta - Tienda Deportiva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        /* Ocultar el título "Pagina de registro" */
        body::before {
            display: none !important;
        }
        /* Ocultar cualquier texto fuera del contenedor principal */
        body > *:not(.register-container) {
            display: none !important;
        }
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .register-container {
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            background-color: #f8f9fa;
        }
        .register-form-container {
            background-color: white;
            display: flex;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            min-height: 500px;
        }
        .register-form {
            flex: 3;
            padding: 1.5rem;
            max-width: none;
        }
        .register-image-container {
            background: linear-gradient(135deg, #2c2c2c 0%, #1a1a1a 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            flex: 2;
            overflow: hidden;
        }
        .register-image-container::before {
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
        .register-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.2);
            z-index: 2;
        }
        .register-image-text {
            position: relative;
            z-index: 3;
            padding: 2rem;
            max-width: 90%;
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
            border-radius: 0.4rem;
            padding: 0.5rem 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 0.75rem;
            letter-spacing: 0.2px;
            font-size: 0.85rem;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #404040 0%, #262626 100%);
        }
        .form-label {
            font-weight: 500;
            color: #404040;
            margin-bottom: 0.25rem;
            font-size: 0.85rem;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
            color: #404040;
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
        }
        .input-group .form-control {
            border-left: none;
            padding: 0.5rem 0.75rem;
            height: auto;
            font-size: 0.85rem;
        }
        .mb-4 {
            margin-bottom: 1rem !important;
        }
        .mb-3 {
            margin-bottom: 0.75rem !important;
        }
        .register-link {
            color: #404040;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            border-bottom: 1px solid transparent;
        }
        .register-link:hover {
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
        .error { color: #dc3545; font-size: 0.875rem; margin-top: 0.25rem; }
        .success { color: #198754; font-size: 0.875rem; margin-top: 0.25rem; }
        @media (max-width: 991.98px) {
            .register-container {
                flex-direction: column-reverse;
                height: auto;
            }
            .register-image-container {
                min-height: 30vh;
            }
            .register-form-container {
                padding: 2rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-form-container">
            <div class="register-form">
                <form action="?action=registre-session" method="post">
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger mb-3" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre de usuario</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="username" name="username" maxlength="20" minlength="4" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="second_name" class="form-label">Apellidos</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                <input type="text" class="form-control" id="second_name" name="second_name" required>
                            </div>
                        </div>
                    </div>
                            
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div id="email-status"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                            <input type="text" class="form-control" id="direccion" name="direccion">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="postal" class="form-label">Código Postal</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" id="postal" name="postal" pattern="[0-9]{5}" title="El código postal debe tener 5 dígitos">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="tel" class="form-control" id="telefono" name="telefono" pattern="[0-9]{9}" title="El teléfono debe tener 9 dígitos">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" minlength="4" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmar contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" minlength="4" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="pregunta_seguridad" class="form-label">Pregunta de seguridad</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-question-circle"></i></span>
                            <select class="form-select" id="pregunta_seguridad" name="pregunta_seguridad" required>
                                <option value="">Selecciona una pregunta</option>
                                <option value="¿Cuál es el nombre de tu primera mascota?">¿Cuál es el nombre de tu primera mascota?</option>
                                <option value="¿En qué ciudad naciste?">¿En qué ciudad naciste?</option>
                                <option value="¿Cuál es el nombre de soltera de tu madre?">¿Cuál es el nombre de soltera de tu madre?</option>
                                <option value="¿Cuál fue tu primer coche?">¿Cuál fue tu primer coche?</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="respuesta_seguridad" class="form-label">Respuesta</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <input type="text" class="form-control" id="respuesta_seguridad" name="respuesta_seguridad" required>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn btn-primary">Crear cuenta</button>
                    </div>
                    
                    <div class="text-center">
                        <p>¿Ya tienes una cuenta? <a href="?action=pagina-login" class="register-link">Iniciar sesión</a></p>
                    </div>
                </form>
            </div>
            
            <div class="register-image-container">
                <div class="register-image-overlay"></div>
                <div class="register-image-text">
                    <h2 class="mb-3">Únete a nuestra comunidad</h2>
                    <p class="mb-3">Crea tu cuenta y disfruta de ofertas exclusivas en moda deportiva</p>
                    <img src="/PaginaWeb_BU/public/imagenes/home/inicio registro.png" alt="Deportes" class="img-fluid rounded" style="max-width: 80%">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function(){
        // Validación de email
        $('#email').blur(function(){
            var email = $(this).val();
            if(email != '') {
                $.ajax({
                    url: '?action=check-email',
                    method: 'POST',
                    data: {email: email},
                    success: function(response){
                        if(response == 'exists'){
                            $('#email-status').html('<div class="error">Este email ya está registrado</div>');
                        } else {
                            $('#email-status').html('<div class="success">Email disponible</div>');
                        }
                    }
                });
            }
        });
        
        // Validación de contraseñas coincidentes
        $('#confirm_password').on('input', function() {
            var password = $('#password').val();
            var confirmPassword = $(this).val();
            
            if (password === confirmPassword) {
                $(this).removeClass('is-invalid').addClass('is-valid');
            } else {
                $(this).removeClass('is-valid').addClass('is-invalid');
            }
        });
        
        // Validación del formulario antes de enviar
        $('form').submit(function(e) {
            var password = $('#password').val();
            var confirmPassword = $('#confirm_password').val();
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Las contraseñas no coinciden');
                return false;
            }
            return true;
        });
    });
    </script>
</body>
</html>