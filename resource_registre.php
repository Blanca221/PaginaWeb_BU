<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro - Tienda Deportiva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <!-- /**
        * Página de registro de usuarios
        * 
        * Esta página proporciona un formulario completo para el registro de usuarios con:
        * - Validación en tiempo real del email mediante AJAX
        * - Validación de campos en el lado del cliente
        * - Preguntas de seguridad para recuperación de cuenta
        * - Mensajes de feedback para el usuario
        * 
        * @requires jQuery 3.5.1
        * @requires controller/llistar_mensaje_registre.php
        */-->
    <?php require __DIR__ . '/controller/llistar_mensaje_registre.php'; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Crear cuenta nueva</h2>
                        <form action="?action=registre-session" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nombre de usuario</label>
                                <input type="text" class="form-control" id="username" name="username" maxlength="20" minlength="4" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="second_name" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="second_name" name="second_name" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <span id="email_result"></span>
                            </div>
                            
                            <div class="mb-3">
                                <label for="pregunta_seguridad" class="form-label">Pregunta de seguridad</label>
                                <select class="form-select" name="pregunta_seguridad" id="pregunta_seguridad" required>
                                    <option value="">Seleccione una pregunta</option>
                                    <option value="¿Cuál es el nombre de tu primera mascota?">¿Cuál es el nombre de tu primera mascota?</option>
                                    <option value="¿En qué ciudad naciste?">¿En qué ciudad naciste?</option>
                                    <option value="¿Cuál es el nombre de tu mejor amigo de la infancia?">¿Cuál es el nombre de tu mejor amigo de la infancia?</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="respuesta_seguridad" class="form-label">Respuesta de seguridad</label>
                                <input type="text" class="form-control" id="respuesta_seguridad" name="respuesta_seguridad" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="postal_code" class="form-label">Código postal</label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code" pattern="[0-9]+" maxlength="5" minlength="5">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono">
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Crear cuenta</button>
                            </div>
                        </form>
                        
                        <div class="text-center mt-4">
                            <p>¿Ya tienes una cuenta? <a href="?action=pagina-login" class="text-decoration-none">Iniciar sesión</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#email').blur(function(){
            var email = $(this).val();
            if(email != '') {
                $.ajax({
                    url: '?action=check-email',
                    method: 'POST',
                    data: {email: email},
                    success: function(response){
                        if(response == 'exists'){
                            $('#email_result').html('Este email ya está registrado').removeClass('success').addClass('error');
                        } else {
                            $('#email_result').html('Email disponible').removeClass('error').addClass('success');
                        }
                    }
                });
            }
        });
    });
    </script>
</body>
</html>