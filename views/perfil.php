<?php
require_once __DIR__ . '/components/header.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Mi Perfil</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h4 class="mb-3">Información Personal</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Nombre de Usuario:</strong> <?php echo htmlspecialchars($usuario['username']); ?></p>
                                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['first_name']); ?></p>
                                    <p><strong>Apellido:</strong> <?php echo htmlspecialchars($usuario['second_name']); ?></p>
                                    <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Dirección:</strong> <?php echo htmlspecialchars($usuario['direccion']); ?></p>
                                    <p><strong>Código Postal:</strong> <?php echo htmlspecialchars($usuario['postal']); ?></p>
                                    <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($usuario['telefono']); ?></p>
                                    <p><strong>Tipo de Cuenta:</strong> <?php echo ucfirst(htmlspecialchars($usuario['rol'])); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if ($usuario['rol'] === 'administrador'): ?>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <i class="fas fa-shield-alt"></i> Cuenta con privilegios de administrador
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="row mt-4">
                        <div class="col-md-12 text-center">
                            <a href="index.php?action=editar-perfil" class="btn btn-primary me-2">
                                <i class="fas fa-edit"></i> Editar Perfil
                            </a>
                            <a href="index.php?action=cambiar-password" class="btn btn-secondary">
                                <i class="fas fa-key"></i> Cambiar Contraseña
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/components/footer.php'; ?>
