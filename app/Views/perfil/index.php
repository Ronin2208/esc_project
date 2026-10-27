<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$carpetaUploads = '/esc_project/public/uploads/';
$fotoPerfil = $perfil['foto'] ?? '';
$rutaFotoLocal = $_SERVER['DOCUMENT_ROOT'] . $carpetaUploads . $fotoPerfil;

if (!empty($fotoPerfil) && file_exists($rutaFotoLocal)) {
    $fotoUrl = $carpetaUploads . $fotoPerfil;
} else {
    $fotoUrl = 'https://ui-avatars.com/api/?name=' . urlencode($perfil['nombre']) . '&background=0d6efd&color=fff&size=200';
}

$ambiente = $perfil['ambiente'] ?? 'dark';
$accentColor = $perfil['color_accent'] ?? '#0dcaf0';
$efecto = $perfil['efecto'] ?? 'glow';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil Personalizado - E.S.C.</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --accent-color: <?= $accentColor ?>;
        }

        /* --- FONDOS Y TEMAS --- */
        <?php if ($ambiente === 'neon'): ?>
            body { background: #030712; color: #ffffff; font-family: 'Segoe UI', sans-serif; }
            .card-custom { background: #0b1329; border: 1px solid var(--accent-color); }
        <?php elseif ($ambiente === 'green'): ?>
            body { background: #04140c; color: #ffffff; font-family: 'Segoe UI', sans-serif; }
            .card-custom { background: #0b2417; border: 1px solid #198754; }
        <?php elseif ($ambiente === 'purple'): ?>
            body { background: #12031a; color: #ffffff; font-family: 'Segoe UI', sans-serif; }
            .card-custom { background: #220930; border: 1px solid #d63384; }
        <?php elseif ($ambiente === 'light'): ?>
            body { background: #f8fafc; color: #0f172a; font-family: 'Segoe UI', sans-serif; }
            .card-custom { background: #ffffff; border: 1px solid #e2e8f0; }
            p, label, h4, h5, h6, span, .text-white { color: #0f172a !important; }
        <?php elseif ($ambiente === 'gradient'): ?>
            body { background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #030712 100%); color: #ffffff; font-family: 'Segoe UI', sans-serif; }
            .card-custom { background: rgba(15, 23, 42, 0.85); border: 1px solid var(--accent-color); }
        <?php else: ?>
            body { background: #0b0e14; color: #ffffff; font-family: 'Segoe UI', sans-serif; }
            .card-custom { background: #131b26; border: 1px solid #1e2d3d; }
        <?php endif; ?>

        /* --- EFECTOS ESPECIALES --- */
        <?php if ($efecto === 'glow'): ?>
            .card-custom { box-shadow: 0 0 25px var(--accent-color); }
            .profile-avatar { box-shadow: 0 0 20px var(--accent-color); }
        <?php elseif ($efecto === 'glass'): ?>
            .card-custom { backdrop-filter: blur(12px); background: rgba(255, 255, 255, 0.05) !important; border: 1px solid rgba(255, 255, 255, 0.18); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37); }
        <?php elseif ($efecto === 'floating'): ?>
            .card-custom { transition: transform 0.3s ease, box-shadow 0.3s ease; }
            .card-custom:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,0.5); }
        <?php elseif ($efecto === 'border-pulse'): ?>
            @keyframes borderPulse {
                0% { border-color: var(--accent-color); box-shadow: 0 0 5px var(--accent-color); }
                50% { border-color: #ffffff; box-shadow: 0 0 20px var(--accent-color); }
                100% { border-color: var(--accent-color); box-shadow: 0 0 5px var(--accent-color); }
            }
            .card-custom { animation: borderPulse 3s infinite; }
        <?php endif; ?>

        .btn-accent { background-color: var(--accent-color); color: #000; font-weight: bold; border: none; }
        .btn-accent:hover { opacity: 0.9; color: #000; }
        .text-accent { color: var(--accent-color) !important; }
        .profile-avatar { width: 140px; height: 140px; object-fit: cover; border-radius: 50%; border: 4px solid var(--accent-color); }
        .prod-card-img { height: 150px; object-fit: contain; width: 100%; background: #0d131d; padding: 10px; border-radius: 8px 8px 0 0; }
    </style>
</head>
<body class="py-4">

<div class="container" style="max-width: 1050px;">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0 text-accent"><i class="fa-solid fa-wand-magic-sparkles me-2"></i>Personalización Avanzada del Perfil</h3>
        <a href="/esc_project/public/" class="btn btn-outline-light btn-sm fw-bold">
            <i class="fa-solid fa-arrow-left me-1"></i> Volver al Inicio
        </a>
    </div>

    <?php if (isset($mensajeExito)): ?>
        <div class="alert alert-success alert-dismissible fade show fw-semibold shadow-sm" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i><?= $mensajeExito ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        
        <!-- VISTA PREVIA DEL PERFIL -->
        <div class="col-lg-4">
            <div class="card card-custom p-4 text-center h-100 rounded-4">
                
                <div class="mb-3">
                    <img src="<?= htmlspecialchars($fotoUrl) ?>" alt="Foto de Perfil" class="profile-avatar">
                </div>
                
                <h4 class="fw-bold mb-1 text-white"><?= htmlspecialchars($perfil['nombre']) ?></h4>
                <span class="badge bg-primary px-3 py-2 text-white rounded-pill mb-3"><?= htmlspecialchars($perfil['rol']) ?></span>

                <div class="border-top border-secondary pt-3 text-start small">
                    <p class="mb-2 text-white"><i class="fa-solid fa-star text-warning me-2"></i>Calificación: <strong><?= $perfil['calificacion'] ?> / 5.0</strong></p>
                    <p class="mb-2 text-white"><i class="fa-solid fa-shield-check text-success me-2"></i>Ventas: <strong><?= $perfil['ventas_completadas'] ?></strong></p>
                    <p class="mb-2 text-white"><i class="fa-solid fa-envelope text-accent me-2"></i><?= htmlspecialchars($perfil['email']) ?></p>
                    <p class="mb-2 text-white"><i class="fa-solid fa-phone text-accent me-2"></i><?= htmlspecialchars($perfil['telefono']) ?></p>
                    <p class="mb-2 text-white"><i class="fa-solid fa-location-dot text-accent me-2"></i><?= htmlspecialchars($perfil['ciudad']) ?></p>
                    <p class="mb-0 text-white"><i class="fa-solid fa-house text-accent me-2"></i><?= htmlspecialchars($perfil['direccion']) ?></p>
                </div>
            </div>
        </div>

        <!-- FORMULARIO DE PERSONALIZACIÓN COMPLETA -->
        <div class="col-lg-8">
            <div class="card card-custom p-4 rounded-4">
                <h5 class="fw-bold mb-3 text-accent"><i class="fa-solid fa-sliders me-2"></i>Ajustes de Información, Fondo y Efectos</h5>
                
                <form action="/esc_project/public/index.php?url=perfil" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-white">Nombre Completo</label>
                            <input type="text" name="nombre" class="form-control bg-dark text-white border-secondary" value="<?= htmlspecialchars($perfil['nombre']) ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-white">Teléfono / WhatsApp</label>
                            <input type="text" name="telefono" class="form-control bg-dark text-white border-secondary" value="<?= htmlspecialchars($perfil['telefono']) ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-white">Ciudad</label>
                            <input type="text" name="ciudad" class="form-control bg-dark text-white border-secondary" value="<?= htmlspecialchars($perfil['ciudad']) ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-white">Rol en la Plataforma</label>
                            <select name="rol" class="form-select bg-dark text-white border-secondary">
                                <option value="Comprador y Vendedor" <?= $perfil['rol'] === 'Comprador y Vendedor' ? 'selected' : '' ?>>Comprador y Vendedor</option>
                                <option value="Solo Comprador" <?= $perfil['rol'] === 'Solo Comprador' ? 'selected' : '' ?>>Solo Comprador</option>
                                <option value="Solo Vendedor" <?= $perfil['rol'] === 'Solo Vendedor' ? 'selected' : '' ?>>Solo Vendedor</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label small fw-bold text-white">Dirección Principal</label>
                            <input type="text" name="direccion" class="form-control bg-dark text-white border-secondary" value="<?= htmlspecialchars($perfil['direccion']) ?>" required>
                        </div>

                        <!-- 1. PERSONALIZACIÓN DE FONDO / TEMA -->
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-white"><i class="fa-solid fa-image me-1 text-accent"></i> Fondo / Tema</label>
                            <select name="ambiente" class="form-select bg-dark text-white border-secondary">
                                <option value="dark" <?= $ambiente === 'dark' ? 'selected' : '' ?>>Oscuro Fintech</option>
                                <option value="neon" <?= $ambiente === 'neon' ? 'selected' : '' ?>>Ciber Neón</option>
                                <option value="green" <?= $ambiente === 'green' ? 'selected' : '' ?>>Verde Éxito</option>
                                <option value="purple" <?= $ambiente === 'purple' ? 'selected' : '' ?>>Púrpura Gaming</option>
                                <option value="gradient" <?= $ambiente === 'gradient' ? 'selected' : '' ?>>Degradado Futurist</option>
                                <option value="light" <?= $ambiente === 'light' ? 'selected' : '' ?>>Claro / Día</option>
                            </select>
                        </div>

                        <!-- 2. PERSONALIZACIÓN DE COLOR DE ACENTO -->
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-white"><i class="fa-solid fa-palette me-1 text-accent"></i> Color Luces</label>
                            <select name="color_accent" class="form-select bg-dark text-white border-secondary">
                                <option value="#0dcaf0" <?= $accentColor === '#0dcaf0' ? 'selected' : '' ?>>Cyan Brillante</option>
                                <option value="#0d6efd" <?= $accentColor === '#0d6efd' ? 'selected' : '' ?>>Azul Eléctrico</option>
                                <option value="#198754" <?= $accentColor === '#198754' ? 'selected' : '' ?>>Verde Esmeralda</option>
                                <option value="#d63384" <?= $accentColor === '#d63384' ? 'selected' : '' ?>>Rosa Magenta</option>
                                <option value="#fd7e14" <?= $accentColor === '#fd7e14' ? 'selected' : '' ?>>Naranja Fuego</option>
                                <option value="#ffc107" <?= $accentColor === '#ffc107' ? 'selected' : '' ?>>Amarillo Oro</option>
                            </select>
                        </div>

                        <!-- 3. PERSONALIZACIÓN DE EFECTO VISUAL -->
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-white"><i class="fa-solid fa-sparkles me-1 text-accent"></i> Efecto Especial</label>
                            <select name="efecto" class="form-select bg-dark text-white border-secondary">
                                <option value="glow" <?= $efecto === 'glow' ? 'selected' : '' ?>>Brillo Neón (Glow)</option>
                                <option value="glass" <?= $efecto === 'glass' ? 'selected' : '' ?>>Vidrio (Glassmorphism)</option>
                                <option value="floating" <?= $efecto === 'floating' ? 'selected' : '' ?>>Flotante 3D</option>
                                <option value="border-pulse" <?= $efecto === 'border-pulse' ? 'selected' : '' ?>>Borde Pulsante</option>
                                <option value="none" <?= $efecto === 'none' ? 'selected' : '' ?>>Sin Efecto</option>
                            </select>
                        </div>

                        <!-- FOTO DE PERFIL -->
                        <div class="col-12">
                            <label class="form-label small fw-bold text-white"><i class="fa-solid fa-camera me-1 text-accent"></i> Subir Nueva Imagen de Perfil</label>
                            <input type="file" name="foto" class="form-control bg-dark text-white border-secondary" accept="image/*">
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-accent w-100 py-2 fs-6">
                                <i class="fa-solid fa-floppy-disk me-2"></i> Guardar Todos los Cambios
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- PRODUCTOS EN VENTA -->
    <div class="card card-custom p-4 mt-5 rounded-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold m-0 text-accent"><i class="fa-solid fa-boxes-stacked me-2"></i>Mis Productos Publicados</h5>
            <a href="/esc_project/public/index.php?url=producto/crear" class="btn btn-success btn-sm fw-bold">
                <i class="fa-solid fa-plus me-1"></i> Publicar Artículo
            </a>
        </div>

        <?php if (!empty($misProductos)): ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($misProductos as $p): ?>
                    <?php 
                        $imgProd = $p['imagen'] ?? '';
                        $rutaLocalImg = $_SERVER['DOCUMENT_ROOT'] . $carpetaUploads . $imgProd;
                        $srcImg = (!empty($imgProd) && file_exists($rutaLocalImg)) ? $carpetaUploads . $imgProd : $carpetaUploads . 'laptop.jpg';
                    ?>
                    <div class="col">
                        <div class="border border-secondary rounded overflow-hidden bg-dark h-100 d-flex flex-column justify-content-between">
                            <div>
                                <img src="<?= htmlspecialchars($srcImg) ?>" class="prod-card-img" alt="Producto">
                                <div class="p-3">
                                    <h6 class="fw-bold text-white mb-1"><?= htmlspecialchars($p['nombre']) ?></h6>
                                    <p class="text-secondary small mb-2"><?= htmlspecialchars(mb_strimwidth($p['descripcion'], 0, 75, '...')) ?></p>
                                </div>
                            </div>
                            <div class="p-3 border-top border-secondary d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-success fs-5">$<?= htmlspecialchars($p['precio']) ?></span>
                                <a href="/esc_project/public/index.php?url=producto/editar&id=<?= $p['id'] ?>" class="btn btn-outline-warning btn-sm">
                                    <i class="fa-solid fa-pen"></i> Editar
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-4 text-muted">
                <i class="fa-solid fa-box-open fs-1 mb-2"></i>
                <p class="mb-0">Aún no has publicado productos.</p>
            </div>
        <?php endif; ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>