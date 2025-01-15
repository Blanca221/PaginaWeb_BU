<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button id="boton">Click me</button>
    <div id="result"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        let saludo = $("#boton");
        // Realiza una petición GET a la URL especificada con AJAX
        saludo.click(function() {
            $.ajax({
                url: "?action=llistar-productes",
                type: "GET",//esta haciendo una petición al servidor a esa url
                success: function(response) {//si se hace correctamente
                    $("#result").html(response); //el div imprimira el resultado
                },
                error: function(error) {//sino mostrara un herror
                    console.log(error);
                }
            });
        });
    </script>
</body>
</html>