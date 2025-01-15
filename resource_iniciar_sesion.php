<!--Ejercicio [11]
    Crea una pagina para iniciar sesion y que sea funcional. Tienes que comprobar si el usuario y la password corresponde con las
        que hayas creado anteriormente.
-->

<html lang="ca">

<head>
    <title>Inicio de sesion - TDIW</title>
</head>
<body>
    <!--Aqui esta haciendo el login y para hacer la comprobacion lo en via a la ruta inicio-session que tiene el controlador(iniciar_sesion.php)-->
    <div class="container">
        <form action="?action=inicio-session" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" maxlength="20" minlength="4" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br>
            <input type="submit" value="Submit">
        </form>

</body>

</html>