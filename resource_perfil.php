<?php
// RECURSO DE PERFIL DE USUARIO

// Verificar si el usuario está logueado
require_once __DIR__ . '/model/usuarios.php';
if (!estaLogueado()) {
    header('Location: index.php?action=pagina-login');
    exit;
}

// Obtener los datos del usuario
require_once __DIR__ . '/model/connectaDB.php';
$conexion = DB::getInstance();
$stmt = $conexion->prepare('SELECT * FROM cliente WHERE id_cliente = ?');
$stmt->execute([$_SESSION['id_cliente']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Título de la página
$pageTitle = 'Mi Perfil - Tienda Deportiva';

// Iniciar el buffer de salida
ob_start();
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
                                    <p><strong>Nombre de Usuario:</strong> <?php echo isset($usuario['username']) ? htmlspecialchars($usuario['username']) : ''; ?></p>
                                    <p><strong>Nombre:</strong> <?php echo isset($usuario['first_name']) ? htmlspecialchars($usuario['first_name']) : ''; ?></p>
                                    <p><strong>Apellido:</strong> <?php echo isset($usuario['second_name']) ? htmlspecialchars($usuario['second_name']) : ''; ?></p>
                                    <p><strong>Email:</strong> <?php echo isset($usuario['email']) ? htmlspecialchars($usuario['email']) : ''; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Dirección:</strong> <?php echo isset($usuario['direccion']) ? htmlspecialchars($usuario['direccion']) : ''; ?></p>
                                    <p><strong>Código Postal:</strong> <?php echo isset($usuario['postal']) ? htmlspecialchars($usuario['postal']) : ''; ?></p>
                                    <p><strong>Teléfono:</strong> <?php echo isset($usuario['telefono']) ? htmlspecialchars($usuario['telefono']) : ''; ?></p>
                                    <p><strong>Tipo de Cuenta:</strong> <?php echo isset($usuario['rol']) ? ucfirst(htmlspecialchars($usuario['rol'])) : ''; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if (isset($usuario['rol']) && $usuario['rol'] === 'administrador'): ?>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <i class="fas fa-shield-alt"></i> Cuenta con privilegios de administrador
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Obtener el contenido del buffer
$content = ob_get_clean();

// Incluir el layout principal (exactamente igual que en la página principal)
require_once __DIR__ . '/views/layouts/main.php';
?>
