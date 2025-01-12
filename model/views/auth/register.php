<?php include 'views/templates/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Registro</h3>
                </div>
                <div class="card-body">
                    <form action="index.php?action=register" method="POST" id="registerForm">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text" name="apellido" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                            <small id="emailFeedback" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('email').addEventListener('blur', function() {
    const email = this.value;
    const feedback = document.getElementById('emailFeedback');
    
    fetch('index.php?action=checkEmail', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'email=' + encodeURIComponent(email)
    })
    .then(response => response.json())
    .then(data => {
        if (data.exists) {
            feedback.textContent = 'Este email ya está registrado';
            feedback.className = 'form-text text-danger';
        } else {
            feedback.textContent = 'Email disponible';
            feedback.className = 'form-text text-success';
        }
    });
});
</script>

<?php include 'views/templates/footer.php'; ?>