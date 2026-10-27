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
    <title><?= htmlspecialchars($producto['nombre'] ?? 'Detalle del Producto') ?> | E.S.C.</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #0b0e14; 
            color: #e2e8f0; 
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
        }
        .navbar-custom { 
            background-color: #131b26; 
            border-bottom: 1px solid #1e2d3d; 
        }
        .card-custom { 
            background-color: #131b26; 
            border: 1px solid #1e2d3d; 
            border-radius: 12px; 
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
        }
        .img-box { 
            background-color: #0a0f18; 
            border-radius: 10px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            min-height: 380px; 
            padding: 20px;
            border: 1px dashed #2a3b50;
        }
        .img-box img { 
            max-height: 340px; 
            width: 100%; 
            object-fit: contain; 
        }
        .esc-badge {
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            border: 1px solid #3d8bfd;
        }
    </style>
</head>
<body>

<!-- Menú Superior de Navegación -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom py-3 mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary fs-4 d-flex align-items-center gap-2" href="/esc_project/public/">
            <i class="fa-solid fa-shield-halved text-info"></i> E.S.C.
            <span class="badge bg-secondary fs-6 fw-normal d-none d-sm-inline-block">Entrega Segura y Confiable</span>
        </a>
        
        <div class="d-flex align-items-center gap-2 ms-auto">
            <a href="/esc_project/public/" class="btn btn-outline-light btn-sm">
                <i class="fa-solid fa-house me-1"></i> Inicio
            </a>
            
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <a href="/esc_project/public/index.php?url=usuario/perfil" class="btn btn-outline-info btn-sm">
                    <i class="fa-solid fa-user me-1"></i> <?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Mi Perfil') ?>
                </a>
                <a href="/esc_project/public/index.php?url=auth/logout" class="btn btn-outline-danger btn-sm" title="Cerrar Sesión">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            <?php else: ?>
                <a href="/esc_project/public/index.php?url=auth/login" class="btn btn-primary btn-sm fw-bold">
                    <i class="fa-solid fa-right-to-bracket me-1"></i> Ingresar
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Contenido Principal -->
<div class="container py-2">
    <!-- Migas de pan / Botón Volver -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="/esc_project/public/" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Volver al Catálogo
        </a>
        <span class="badge esc-badge px-3 py-2 fs-6 rounded-pill">
            <i class="fa-solid fa-lock me-1"></i> Transacción Retenida en Custodia
        </span>
    </div>

    <div class="row g-4">
        <!-- Columna Izquierda: Imagen del Producto -->
        <div class="col-lg-6">
            <div class="card card-custom p-3">
                <div class="img-box">
                    <img src="<?= htmlspecialchars($producto['imagen_url']) ?>" 
                         alt="<?= htmlspecialchars($producto['nombre'] ?? 'Producto') ?>"
                         onerror="this.onerror=null; this.src='https://via.placeholder.com/500x350/0a0f18/00fff2?text=Imagen+No+Disponible';">
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Información y Acción -->
        <div class="col-lg-6">
            <div class="card card-custom p-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h1 class="fw-bold text-white h2 mb-0"><?= htmlspecialchars($producto['nombre'] ?? 'Producto no especificado') ?></h1>
                        <span class="badge bg-success-subtle text-success border border-success px-2 py-1">Disponible</span>
                    </div>

                    <h2 class="text-success fw-bold display-6 mb-4">$<?= htmlspecialchars($producto['precio'] ?? '0') ?> <small class="fs-6 text-muted">COP</small></h2>

                    <h5 class="text-light border-bottom border-secondary pb-2 mb-3">Descripción</h5>
                    <p class="text-secondary lh-base mb-4">
                        <?= nl2br(htmlspecialchars($producto['descripcion'] ?? 'Sin descripción disponible para este artículo.')) ?>
                    </p>
                </div>

                <div>
                    <!-- Tarjeta Informativa de Custodia E.S.C. -->
                    <div class="alert alert-dark border border-info-subtle bg-opacity-25 bg-info text-info p-3 mb-4 rounded-3">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="fa-solid fa-shield-halved fs-5"></i>
                            <strong class="text-white">Garantía Anti-Fraude E.S.C.</strong>
                        </div>
                        <small class="text-light opacity-75 d-block">
                            Tu pago no se entregará al vendedor hasta que recibas el producto e inspeciones que se encuentra en correctas condiciones.
                        </small>
                    </div>

                    <!-- Botón de Acción -->
                    <a href="/esc_project/public/index.php?url=compra/iniciar/<?= htmlspecialchars($producto['id'] ?? 1) ?>" 
                       class="btn btn-primary btn-lg w-100 fw-bold py-3 fs-5 text-uppercase shadow">
                        <i class="fa-solid fa-cart-shopping me-2"></i> Iniciar Compra Segura
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>