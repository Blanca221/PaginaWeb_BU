/**
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
 */

<html lang="ca">
<head>
    <title>Registre - TDIW</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <?php require __DIR__ . '/controller/llistar_mensaje_registre.php'; ?>

    <div class="container">
        <form action="?action=registre-session" method="post">
            <!-- Campos existentes -->
            <label for="username">Nombre de usuario:</label><br>
            <input type="text" id="username" name="username" maxlength="20" minlength="4" required><br>
            
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            
            <label for="first_name">First name:</label><br>
            <input type="text" id="first_name" name="first_name" required><br>
            
            <label for="second_name">Second name:</label><br>
            <input type="text" id="second_name" name="second_name" required><br>
            
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required>
            <span id="email_result"></span><br>
            
            <!-- Añadimos las preguntas de seguridad -->
            <label for="pregunta_seguridad">Pregunta de seguridad:</label><br>
            <select name="pregunta_seguridad" id="pregunta_seguridad" required>
                <option value="">Seleccione una pregunta</option>
                <option value="¿Cuál es el nombre de tu primera mascota?">¿Cuál es el nombre de tu primera mascota?</option>
                <option value="¿En qué ciudad naciste?">¿En qué ciudad naciste?</option>
                <option value="¿Cuál es el nombre de tu mejor amigo de la infancia?">¿Cuál es el nombre de tu mejor amigo de la infancia?</option>
            </select><br>

            <label for="respuesta_seguridad">Respuesta de seguridad:</label><br>
            <input type="text" id="respuesta_seguridad" name="respuesta_seguridad" required><br>
            
            <!-- Resto de campos existentes -->
            <label for="direccion">Direccion:</label><br>
            <input type="text" id="direccion" name="direccion"><br>
            
            <label for="postal_code">Postal code:</label><br>
            <input type="text" id="postal_code" name="postal_code" pattern="[0-9]+" maxlength="5" minlength="5"><br>
            
            <label for="telefono">Telefono:</label><br>
            <input type="tel" id="telefono" name="telefono"><br>
            
            <input type="submit" value="Submit">
        </form>
    </div>

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