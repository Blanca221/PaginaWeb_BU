html lang="ca">

<head>
    <title>Registre - TDIW</title>
</head>

<body>
<!--Ejercicio 4 
Crea una nueva ruta llamada "registre", y crea una pagina con los siguientes campos:
        username
        password
        first_name
        email
        postal

        El formulario tiene que enviar los resultados a la ruta "registre-session.php"
        Utiliza la siguiente plantilla:

        ```
        <h2> [Este mensaje tienes que cogerlo de la base de datos, id del mensaje es el 2] </h2>
        <form action="?action=registre-session.php" method="post">


[7] (F) Crea una validacion de cliente, los campos tienen que cumplir los siguientes requisitos.
        username: debe tener entre 4 y 20 caracteres
        password: debe tener entre 4 y 20 caracteres
        first_name: debe tener entre 4 y 40 caracteres
        email: debe tener un formato de email
        postal: debe tener 5 catacteres !!numericos!! Pista: pattern="[0-9]+"
        "TODOS": deben ser obligatorio.
        Pista: no hace falta usar js, desde el html se puede hacer

-->
    <?php require __DIR__ . '/controller/llistar_mensaje_registre.php'; ?>

    <div class="container">
        <form action="?action=registre-session" method="post">
            <!--Esto lo buscara el index y se ira al contralador
        case 'registre-session':
        include __DIR__.'/controller/almacenar_registro.php';
        break;-->
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" maxlength="20" minlength="4" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br>
            <label for="first_name">First name:</label><br>
            <input type="text" id="first_name" name="first_name"><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br>
            <label for="postal_code">Postal code:</label><br>
            <input type="text" id="postal_code" name="postal_code" pattern="[0-9]+" maxlength="5" minlength="5"><br>
            <input type="submit" value="Submit">
        </form>

</body>

</html>