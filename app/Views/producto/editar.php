<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - E.S.C.</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #0b0e14; color: #ffffff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; }
        .card-formulario { background-color: #131b26; border: 1px solid #0dcaf0; border-radius: 16px; box-shadow: 0 10px 30px rgba(13, 202, 240, 0.15); }
        .form-label { color: #e2e8f0 !important; font-weight: 600; font-size: 0.95rem; margin-bottom: 6px; }
        .form-control { background-color: #1c2738 !important; color: #ffffff !important; border: 1px solid #334155 !important; border-radius: 8px; padding: 10px 14px; }
        .form-control:focus { background-color: #222f43 !important; color: #ffffff !important; border-color: #0dcaf0 !important; box-shadow: 0 0 10px rgba(13, 202, 240, 0.3) !important; }
        .btn-actualizar { background-color: #f59e0b; border: none; color: #000000; font-weight: 700; padding: 12px; border-radius: 8px; transition: all 0.2s ease; }
        .btn-actualizar:hover { background-color: #d97706; color: #000000; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center py-5">

<div class="container" style="max-width: 600px;">

    <div class="mb-3">
        <a href="/esc_project/public/" class="btn btn-outline-info btn-sm fw-bold">
            <i class="fa-solid fa-arrow-left me-1"></i> Volver al Catálogo
        </a>
    </div>

    <div class="card card-formulario p-4 p-md-5">
        <h3 class="fw-bold text-warning mb-4 text-center">
            <i class="fa-solid fa-pen-to-square me-2"></i>Editar Producto
        </h3>

        <form action="/esc_project/public/index.php?url=producto/editar&id=<?= htmlspecialchars($productoEditar['id'] ?? '') ?>" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="<?= htmlspecialchars($productoEditar['nombre'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción Detallada</label>
                <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required><?= htmlspecialchars($productoEditar['descripcion'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio (COP)</label>
                <input type="text" id="precio" name="precio" class="form-control" value="<?= htmlspecialchars($productoEditar['precio'] ?? '') ?>" required>
            </div>

            <div class="mb-4">
                <label for="imagen" class="form-label">Cambiar Foto (Opcional)</label>
                <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*">
                <small class="text-secondary d-block mt-1">Si no seleccionas un archivo, se mantendrá la foto actual (<?= htmlspecialchars($productoEditar['imagen'] ?? '') ?>).</small>
            </div>

            <button type="submit" class="btn btn-actualizar w-100 fs-6">
                <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Cambios
            </button>

        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>