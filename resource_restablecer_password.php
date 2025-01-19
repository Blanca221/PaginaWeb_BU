<html lang="ca">
<head>
    <title>Restablecer Contraseña - TDIW</title>
    <link rel="stylesheet" href="public/css/forms.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <!-- Paso 1: Username y pregunta de seguridad -->
        <form id="paso1" action="?action=verificar-seguridad" method="post">
            <h2>Restablecer Contraseña</h2>
            
            <label for="username">Nombre de usuario:</label>
            <input type="text" id="username" name="username" required>
            
            <div id="pregunta-container" class="hidden">
                <p id="pregunta-text"></p>
                <label for="respuesta">Tu respuesta:</label>
                <input type="text" id="respuesta" name="respuesta" required>
            </div>
            
            <button type="button" id="verificar-usuario">Verificar Usuario</button>
            <button type="submit" id="verificar-respuesta" class="hidden">Verificar Respuesta</button>
        </form>

        <!-- Paso 2: Nueva contraseña (inicialmente oculto) -->
        <form id="paso2" action="?action=cambiar-password" method="post" class="hidden">
            <h2>Nueva Contraseña</h2>
            <label for="new_password">Nueva contraseña:</label>
            <input type="password" id="new_password" name="new_password" required>
            
            <label for="confirm_password">Confirma la contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <input type="hidden" id="username_final" name="username_final">
            <input type="submit" value="Cambiar contraseña">
        </form>
    </div>
</body>
</html>

    <script>
    $(document).ready(function(){
        // Verificar usuario y mostrar pregunta de seguridad
        $('#verificar-usuario').click(function(){
            const username = $('#username').val();
            if(!username) {
                alert('Por favor, introduce un nombre de usuario');
                return;
            }

            $.ajax({
                url: '?action=obtener-pregunta',
                method: 'POST',
                data: {username: username},
                success: function(response){
                    const data = JSON.parse(response);
                    if(data.success){
                        $('#pregunta-text').text(data.pregunta);
                        $('#pregunta-container').removeClass('hidden');
                        $('#verificar-usuario').hide();
                        $('#verificar-respuesta').removeClass('hidden');
                    } else {
                        alert('Usuario no encontrado');
                    }
                }
            });
        });

        // Verificar respuesta de seguridad
        $('#paso1').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '?action=verificar-seguridad',
                method: 'POST',
                data: {
                    username: $('#username').val(),
                    respuesta: $('#respuesta').val()
                },
                success: function(response){
                    const data = JSON.parse(response);
                    if(data.success){
                        $('#paso1').hide();
                        $('#username_final').val($('#username').val());
                        $('#paso2').removeClass('hidden');
                    } else {
                        alert('Respuesta incorrecta');
                    }
                }
            });
        });

        // Validar que las contraseñas coincidan
        $('#paso2').submit(function(e){
            if($('#new_password').val() !== $('#confirm_password').val()){
                e.preventDefault();
                alert('Las contraseñas no coinciden');
                return;
            }
            if($('#new_password').val().length < 4){
                e.preventDefault();
                alert('La contraseña debe tener al menos 4 caracteres');
                return;
            }
        });
    });
    </script>
</body>
</html>