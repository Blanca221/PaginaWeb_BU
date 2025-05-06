<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo AJAX</title>
</head>
<body>
    <!-- EJEMPLO DE LLAMADA AJAX A UN ENDPOINT DE LA API -->
    <button id="boton">Cargar productos</button>
    <div id="result"></div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // IMPLEMENTACIÓN DE LLAMADA AJAX
        document.getElementById("boton").addEventListener("click", function() {
            $.ajax({
                url: "?action=llistar-productes",
                type: "GET",
                success: function(response) {
                    document.getElementById("result").innerHTML = response;
                },
                error: function(error) {
                    console.error("Error en la petición:", error);
                }
            });
        });
    </script>
</body>
</html>