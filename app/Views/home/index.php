<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inicializar el catálogo en sesión si no existe
if (!isset($_SESSION['productos']) || !is_array($_SESSION['productos']) || empty($_SESSION['productos'])) {
    $_SESSION['productos'] = [
        [
            'id' => 1,
            'nombre' => 'Almohadas (Set x2)',
            'descripcion' => 'Set de 2 almohadas ergonómicas diseñadas para mantener la columna alineada y relajar los músculos del cuello.',
            'precio' => '46000',
            'imagen' => 'Almoada.png'
        ],
        [
            'id' => 2,
            'nombre' => 'Portátil LENOVO OLED',
            'descripcion' => 'Portátil LENOVO IdeaPad Slim 3 AMD Ryzen 7 7735HS, 24 GB RAM, 1 TB SSD, Pantalla OLED 15.6".',
            'precio' => '2450000',
            'imagen' => 'laptop.jpg'
        ],
        [
            'id' => 3,
            'nombre' => 'Juego de Pesas y Mancuernas',
            'descripcion' => 'Set de mancuernas ajustables de 20 kg con barra de extensión antideslizante para entrenamiento en casa.',
            'precio' => '150000',
            'imagen' => 'images.png'
        ]
    ];
}

$catalogoProductos = $_SESSION['productos'];
$usuarioNombre = $_SESSION['usuario_nombre'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.S.C. - Entrega Segura y Confiable | Catálogo Verificado</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #0b0e14; color: #e2e8f0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; }
        .navbar-custom { background-color: #131b26; border-bottom: 1px solid #1e2d3d; }
        .promo-bar { background: linear-gradient(90deg, #0d6efd 0%, #00d2ff 100%); color: #fff; font-size: 0.85rem; font-weight: 600; padding: 6px 0; }
        .info-card { background-color: #131b26; border: 1px solid #1e2d3d; border-radius: 10px; padding: 20px; text-align: center; height: 100%; transition: transform 0.2s ease; }
        .info-card:hover { border-color: #0d6efd; transform: translateY(-3px); }
        .card-custom { background-color: #131b26; border: 1px solid #1e2d3d; border-radius: 12px; overflow: hidden; position: relative; transition: all 0.2s; }
        .card-custom:hover { border-color: #0dcaf0; box-shadow: 0 10px 20px rgba(13, 202, 240, 0.1); }
        .img-container { background-color: #0d131d; height: 210px; display: flex; align-items: center; justify-content: center; padding: 10px; border-bottom: 1px solid #1e2d3d; }
        .img-container img { max-height: 100%; width: 100%; object-fit: contain; }
        .crud-actions { position: absolute; top: 10px; right: 10px; display: flex; gap: 6px; z-index: 10; }
        .objective-section { background-color: #131b26; border: 1px solid #1e2d3d; border-radius: 12px; padding: 30px; margin-bottom: 30px; }
        .import-section { background-color: #131b26; border: 1px solid #0dcaf0; border-radius: 12px; padding: 25px; margin-bottom: 40px; }
        .step-box { background: #131b26; border: 1px solid #1e2d3d; border-radius: 10px; padding: 20px; text-align: center; height: 100%; }
        .step-num { width: 40px; height: 40px; background: #0d6efd; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; margin: 0 auto 15px auto; }
        .footer-custom { border-top: 1px solid #1e2d3d; background-color: #090c10; padding: 40px 0 20px 0; margin-top: 60px; color: #94a3b8; }
    </style>
</head>
<body>

<!-- BARRA ROTATIVA -->
<div class="promo-bar text-center">
    <div id="carouselPromos" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <i class="fa-solid fa-shield-halved me-2"></i><strong>Protección Escrow:</strong> Retención de fondos en custodia hasta que recibas y pruebes tu compra.
            </div>
            <div class="carousel-item">
                <i class="fa-solid fa-globe me-2"></i><strong>Importación Segura:</strong> Compras en Amazon, eBay y Temu respaldadas e inspeccionadas en Colombia.
            </div>
            <div class="carousel-item">
                <i class="fa-solid fa-truck-fast me-2"></i><strong>Envíos Nacionales:</strong> Alianzas estratégicas con Servientrega y Coordinadora a tarifa especial.
            </div>
            <div class="carousel-item">
                <i class="fa-solid fa-magnifying-glass-location me-2"></i><strong>Puntos de Inspección:</strong> Revisa el estado técnico en tiendas aliadas antes del envío.
            </div>
        </div>
    </div>
</div>

<!-- MENÚ DE NAVEGACIÓN -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom py-3 mb-4 sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary fs-4 d-flex align-items-center gap-2" href="/esc_project/public/">
            <span class="fa-stack text-info" style="font-size: 1.1rem;">
                <i class="fa-solid fa-shield-halved fa-stack-2x text-info"></i>
                <i class="fa-solid fa-cat fa-stack-1x text-warning" style="transform: translateY(-2px) scale(0.85); text-shadow: 0 0 4px #000;"></i>
            </span>
            <span class="text-white fw-bold">E.S.C.</span> 
            <span class="badge bg-primary text-white fs-6">VERIFICADO</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarESC">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarESC">
            <div class="navbar-nav ms-auto align-items-lg-center gap-2 mt-3 mt-lg-0">
                <a class="nav-link active fw-semibold" href="/esc_project/public/">Inicio</a>
                
                <a class="nav-link text-warning fw-bold" href="/esc_project/public/index.php?url=presentacion">
                    <i class="fa-solid fa-graduation-cap me-1"></i> Presentación
                </a>

                <a class="nav-link text-light" href="#como-funciona">Cómo Funciona</a>
                <a class="nav-link text-light" href="#aliados"><i class="fa-solid fa-handshake text-warning me-1"></i> Aliados</a>
                
                <a class="nav-link text-info fw-semibold" href="/esc_project/public/index.php?url=politicas">
                    <i class="fa-solid fa-file-shield me-1"></i> Datos Personales
                </a>

                <a href="/esc_project/public/index.php?url=admin" class="btn btn-outline-info btn-sm">
                    <i class="fa-solid fa-chart-line me-1"></i> Panel E.S.C.
                </a>
                
                <a href="/esc_project/public/index.php?url=ventas" class="btn btn-outline-success btn-sm">
                    <i class="fa-solid fa-file-invoice-dollar me-1"></i> Ventas
                </a>

                <?php if (!empty($usuarioNombre)): ?>
                    <a href="/esc_project/public/index.php?url=perfil" class="btn btn-outline-info btn-sm fw-bold border-info text-info d-flex align-items-center gap-1">
                        <i class="fa-solid fa-circle-user"></i>
                        <span><?= htmlspecialchars($usuarioNombre) ?></span>
                    </a>

                    <a href="/esc_project/public/index.php?url=auth/logout" class="btn btn-outline-danger btn-sm" title="Cerrar Sesión">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                <?php else: ?>
                    <a href="/esc_project/public/index.php?url=auth/login" class="btn btn-outline-light btn-sm">Iniciar Sesión</a>
                    <a href="/esc_project/public/index.php?url=auth/registro" class="btn btn-primary btn-sm">Registrarse</a>
                <?php endif; ?>

                <a href="/esc_project/public/index.php?url=producto/crear" class="btn btn-success btn-sm fw-bold px-3 ms-lg-1">
                    <i class="fa-solid fa-plus me-1"></i> Publicar
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="container py-2">

    <!-- HERO / BANNER PRINCIPAL -->
    <div class="p-5 mb-4 rounded-4 shadow" style="background: linear-gradient(135deg, #131b26 0%, #0d131d 100%); border: 1px solid #1e2d3d;">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge bg-primary text-white mb-2 px-3 py-2 fw-bold">NUEVO ESTÁNDAR DE SEGURIDAD EN COLOMBIA</span>
                <h1 class="display-5 fw-bold text-white mb-3">Compra y Vende sin Miedo a las Estafas Online</h1>
                <p class="text-secondary fs-6 mb-4">
                    Protegemos tu dinero con custodia temporal (Escrow) e inspeccionamos físicamente el estado técnico de los productos o importaciones antes de entregarlos en tus manos.
                </p>
                <div class="d-flex gap-3">
                    <a href="/esc_project/public/index.php?url=producto/crear" class="btn btn-primary fw-bold px-4 py-2">
                        <i class="fa-solid fa-shield-halved me-2"></i> Publicar Artículo Seguro
                    </a>
                    <a href="#como-funciona" class="btn btn-outline-light px-4 py-2">Ver Cómo Funciona</a>
                </div>
            </div>
            <div class="col-lg-5 text-center mt-4 mt-lg-0">
                <span class="fa-stack text-info display-1 opacity-75" style="font-size: 5rem;">
                    <i class="fa-solid fa-shield-halved fa-stack-2x text-info"></i>
                    <i class="fa-solid fa-cat fa-stack-1x text-warning" style="transform: translateY(-4px) scale(0.85); text-shadow: 0 0 10px #000;"></i>
                </span>
                <div class="text-light fw-bold mt-3 fs-5">100% Garantía E.S.C.</div>
            </div>
        </div>
    </div>

    <!-- SECCIÓN OBJETIVO -->
    <div id="objetivo" class="objective-section shadow">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 class="fw-bold text-white mb-3 d-flex align-items-center gap-2">
                    <i class="fa-solid fa-bullseye text-primary"></i> Objetivo de E.S.C.
                </h3>
                <p class="text-secondary mb-0">
                    Garantizar la máxima seguridad, transparencia y confianza en el comercio electrónico entre particulares de Colombia. Eliminamos el riesgo de estafa mediante la <strong>inspección previa del estado técnico del producto</strong>, el transporte mediante empresas aliadas y la <strong>custodia temporal de pagos (Escrow)</strong>, liberando el dinero al vendedor únicamente cuando el comprador verifica la recepción a satisfacción.
                </p>
            </div>
            <div class="col-md-4 text-center mt-3 mt-md-0">
                <i class="fa-solid fa-user-shield text-info display-2 mb-2"></i>
                <div class="fw-bold text-light">Comercio 100% Protegido</div>
            </div>
        </div>
    </div>

    <!-- SECCIÓN CÓMO FUNCIONA -->
    <div id="como-funciona" class="mb-5">
        <div class="text-center mb-4">
            <span class="badge bg-dark text-info border border-info mb-2">PROCESO SEGURO</span>
            <h3 class="fw-bold text-white">¿Cómo Funciona el Sistema E.S.C.?</h3>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="step-box">
                    <div class="step-num">1</div>
                    <h6 class="fw-bold text-white mb-2">Acuerdo y Pago Escrow</h6>
                    <p class="text-secondary small mb-0">El comprador deposita el dinero en la cuenta custodia segura de E.S.C. El vendedor es notificado.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-box">
                    <div class="step-num">2</div>
                    <h6 class="fw-bold text-white mb-2">Inspección Técnica</h6>
                    <p class="text-secondary small mb-0">El producto o importación llega a nuestro punto aliado para verificar su funcionamiento real.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-box">
                    <div class="step-num">3</div>
                    <h6 class="fw-bold text-white mb-2">Envío Garantizado</h6>
                    <p class="text-secondary small mb-0">Despachamos mediante Servientrega o Coordinadora con guía segura y rastreo.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-box">
                    <div class="step-num">4</div>
                    <h6 class="fw-bold text-white mb-2">Liberación de Fondos</h6>
                    <p class="text-secondary small mb-0">Al recibir y verificar a satisfacción, el dinero es transferido al vendedor.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- SECCIÓN DE IMPORTACIONES -->
    <div id="importaciones" class="import-section shadow-sm">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-info text-dark mb-2 fw-bold"><i class="fa-solid fa-globe me-1"></i> SERVICIO DE CASILLERO & CUSTODIA INTERNACIONAL</span>
                <h4 class="fw-bold text-white mb-2">Compras e Importaciones Asistidas</h4>
                <p class="text-secondary mb-0">
                    ¿Deseas comprar en plataformas globales como <strong>Amazon, eBay, Temu o AliExpress</strong>? Con E.S.C. puedes solicitar el envío de tu paquete a nuestro casillero de verificación, donde realizamos la <strong>inspección física y prueba de funcionamiento en Colombia</strong> antes de liberar los fondos o realizar la entrega final en tus manos.
                </p>
            </div>
            <div class="col-lg-4 text-center mt-3 mt-lg-0">
                <div class="d-flex justify-content-center align-items-center gap-4 fs-1 text-info">
                    <i class="fa-brands fa-amazon" title="Amazon"></i>
                    <i class="fa-brands fa-ebay" title="eBay"></i>
                    <i class="fa-solid fa-bag-shopping text-warning" title="Temu / AliExpress"></i>
                </div>
                <small class="text-muted d-block mt-2">Inspección técnica de paquetería importada</small>
            </div>
        </div>
    </div>

    <!-- SECCIÓN DE ALIADOS -->
    <div id="aliados" class="row g-3 mb-5">
        <div class="col-md-3">
            <div class="info-card">
                <i class="fa-solid fa-truck-fast text-primary fs-3 mb-2"></i>
                <h6 class="fw-bold text-white mb-1">Servientrega</h6>
                <p class="text-secondary small mb-0">Envíos nacionales con rastreo seguro y cobertura contra extravíos.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-card">
                <i class="fa-solid fa-boxes-packing text-info fs-3 mb-2"></i>
                <h6 class="fw-bold text-white mb-1">Coordinadora</h6>
                <p class="text-secondary small mb-0">Logística especializada para traslado de mercancía delicada y laptops.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-card">
                <i class="fa-solid fa-vault text-warning fs-3 mb-2"></i>
                <h6 class="fw-bold text-white mb-1">PayU / Escrow</h6>
                <p class="text-secondary small mb-0">Pasarela de pago segura con retención de fondos en custodia.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-card">
                <i class="fa-solid fa-store text-success fs-3 mb-2"></i>
                <h6 class="fw-bold text-white mb-1">Tiendas Aliadas</h6>
                <p class="text-secondary small mb-0">Puntos autorizados para la revisión física e inspección técnica.</p>
            </div>
        </div>
    </div>

    <!-- BUSCADOR Y ENCABEZADO CATÁLOGO -->
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h4 class="fw-bold text-white m-0 d-flex align-items-center gap-2">
                <i class="fa-solid fa-layer-group text-primary"></i> Catálogo Verificado E.S.C.
            </h4>
        </div>
        <div class="col-md-6 mt-3 mt-md-0">
            <div class="input-group">
                <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fa-solid fa-search"></i></span>
                <input type="text" id="buscadorProductos" class="form-control bg-dark text-white border-secondary" placeholder="Buscar productos verificados...">
            </div>
        </div>
    </div>

    <!-- REJILLA DE PRODUCTOS CON RUTA DIRECTA A UPLOADS -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($catalogoProductos as $prod): ?>
            <?php 
                $nombreArchivo = $prod['imagen'] ?? '';
                // Ruta directa web hacia la carpeta uploads
                $rutaFinalImg = !empty($nombreArchivo) ? '/esc_project/public/uploads/' . $nombreArchivo : '';

                // Formateador limpio de precio en pesos colombianos ($ COP)
                $precioLimpio = preg_replace('/[^\d]/', '', $prod['precio'] ?? '0');
                $precioFormateado = (is_numeric($precioLimpio) && $precioLimpio > 0)
                    ? number_format((float)$precioLimpio, 0, ',', '.') 
                    : htmlspecialchars($prod['precio'] ?? '0');
            ?>
            <div class="col">
                <div class="card h-100 card-custom">
                    <div class="crud-actions">
                        <a href="/esc_project/public/index.php?url=producto/editar&id=<?= htmlspecialchars($prod['id'] ?? 1) ?>" 
                           class="btn btn-warning btn-sm text-dark fw-bold" title="Editar Producto">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <a href="/esc_project/public/index.php?url=producto/eliminar&id=<?= htmlspecialchars($prod['id'] ?? 1) ?>" 
                           class="btn btn-danger btn-sm" title="Borrar Producto"
                           onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>

                    <div class="img-container">
                        <?php if (!empty($nombreArchivo)): ?>
                            <img src="<?= htmlspecialchars($rutaFinalImg) ?>" alt="<?= htmlspecialchars($prod['nombre'] ?? 'Producto') ?>" onerror="this.onerror=null; this.src='/esc_project/public/uploads/laptop.jpg';">
                        <?php else: ?>
                            <div class="text-center text-secondary py-4">
                                <i class="fa-solid fa-box-open fs-1 text-info mb-2 d-block"></i>
                                <small>Sin imagen</small>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between p-4">
                        <div>
                            <h5 class="card-title fw-bold text-white mb-2"><?= htmlspecialchars($prod['nombre'] ?? 'Producto') ?></h5>
                            <p class="card-text text-secondary small mb-3">
                                <?= htmlspecialchars($prod['descripcion'] ?? 'Sin descripción disponible') ?>
                            </p>
                        </div>

                        <div>
                            <h4 class="text-success fw-bold mb-3">$<?= $precioFormateado ?> <small class="fs-6 text-muted">COP</small></h4>
                            <a href="/esc_project/public/index.php?url=pago&id=<?= htmlspecialchars($prod['id'] ?? 1) ?>" 
                               class="btn btn-primary w-100 fw-bold py-2 shadow-sm">
                                <i class="fa-solid fa-shield-halved me-1"></i> Iniciar Compra Segura
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer-custom">
    <div class="container text-center small text-muted">
        &copy; 2026 <strong>E.S.C. (Entrega Segura y Confiable)</strong>. Todos los derechos reservados.
    </div>
</footer>

<script>
document.getElementById('buscadorProductos').addEventListener('keyup', function() {
    let filtro = this.value.toLowerCase();
    let tarjetas = document.querySelectorAll('.row-cols-md-2 .col');
    
    tarjetas.forEach(card => {
        let texto = card.innerText.toLowerCase();
        if(texto.includes(filtro)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>