<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nombre = $_SESSION['usuario_nombre'] ?? 'Usuario E.S.C.';
$correo = $_SESSION['usuario_correo'] ?? 'usuario@email.com';
$telefono = $_SESSION['usuario_telefono'] ?? '+57 300 123 4567';
$direccion = $_SESSION['usuario_direccion'] ?? 'Calle 123 #45-67, Bogotá';
$foto = $_SESSION['usuario_foto'] ?? null;
$inicial = strtoupper(substr($nombre, 0, 1));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil | E.S.C.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0b0e14; color: #fff; }
        .card-custom { background-color: #131b26; border: 1px solid #1e2d3d; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">E.S.C. <span class="badge bg-info text-dark fs-6">VERIFICADO</span></h2>
        <a href="/esc_project/public/" class="btn btn-outline-light btn-sm">&larr; Volver al Inicio</a>
    </div>

    <div class="row g-4">
        <!-- Tarjeta de Usuario -->
        <div class="col-md-4">
            <div class="card card-custom p-4 text-center">
                <div class="d-flex justify-content-center mb-3">
                    <?php if ($foto && file_exists('../public/uploads/perfiles/' . $foto)): ?>
                        <img src="/esc_project/public/uploads/perfiles/<?= htmlspecialchars($foto) ?>" class="rounded-circle object-fit-cover" width="100" height="100" alt="Foto">
                    <?php else: ?>
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fs-1 fw-bold" style="width: 100px; height: 100px;">
                            <?= $inicial ?>
                        </div>
                    <?php endif; ?>
                </div>
                <h4 class="fw-bold"><?= htmlspecialchars($nombre) ?></h4>
                <p class="text-muted small"><?= htmlspecialchars($correo) ?></p>
                <span class="badge bg-success w-50 mx-auto">CUENTA VERIFICADA</span>
            </div>
        </div>

        <!-- Formulario Personalizar -->
        <div class="col-md-8">
            <div class="card card-custom p-4">
                <h5 class="text-info mb-3">Personalizar Perfil</h5>
                <form action="/esc_project/public/index.php?url=usuario/actualizarPerfil" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label text-secondary small">Foto de Perfil</label>
                        <input type="file" name="foto_perfil" class="form-control bg-dark text-white border-secondary" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-secondary small">Nombre de Usuario</label>
                        <input type="text" name="nombre" class="form-control bg-dark text-white border-secondary" value="<?= htmlspecialchars($nombre) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-secondary small">Teléfono de Contacto</label>
                        <input type="text" name="telefono" class="form-control bg-dark text-white border-secondary" value="<?= htmlspecialchars($telefono) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-secondary small">Dirección de Envío Principal</label>
                        <input type="text" name="direccion" class="form-control bg-dark text-white border-secondary" value="<?= htmlspecialchars($direccion) ?>">
                    </div>
                    <button type="submit" class="btn btn-success w-100 fw-bold">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>