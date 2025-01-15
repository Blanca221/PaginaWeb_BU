<html lang="ca">

<head>
    <title>Registre - TDIW</title>
</head>

<body>
    
    <?php require __DIR__ . '/controller/llistar_mensaje_registre.php'; ?>

    <div class="container">
        <form action="?action=registre-session" method="post">
            <!--
                Esto lo buscara el index y se ira al contralador case 'registre-session':
                include __DIR__.'/controller/almacenar_registro.php';
                break;
            -->
            <label for="username">Nombre de usuario:</label><br>
            <input type="text" id="username" name="username" maxlength="20" minlength="4" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br>
            <label for="first_name">First name:</label><br>
            <input type="text" id="first_name" name="first_name"><br>
            <label for="second_name">Second name:</label><br>
            <input type="text" id="second_name" name="second_name"><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br>
            <label for="direccion">Direccion:</label><br>
            <input type="direccion" id="direccion" name="direccion"><br>
            <label for="postal_code">Postal code:</label><br>
            <input type="text" id="postal_code" name="postal_code" pattern="[0-9]+" maxlength="5" minlength="5"><br>
            <label for="telefono">Telefono:</label><br>
            <input type="telefono" id="telefono" name="telefono"><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>

</html>