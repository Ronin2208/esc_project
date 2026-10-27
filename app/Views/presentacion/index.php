<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mensajeExito =$mensajeExito ?? '';
$carpetaUploads = '/esc_project/public/uploads/';
$fotoPresentacion =$_SESSION['foto_presentacion'] ?? '';
$rutaFotoLocal =$_SERVER['DOCUMENT_ROOT'] . $carpetaUploads .$fotoPresentacion;

if (!empty($fotoPresentacion) && file_exists($rutaFotoLocal)) {$fotoUrl = $carpetaUploads .$fotoPresentacion;
} else {
    $fotoUrl = 'https://ui-avatars.com/api/?name=Jose+Alejandro+Cortes&background=0dcaf0&color=000&size=200';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoja de Presentación - Proyecto E.S.C.</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #0b0e14; color: #ffffff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; }
        .card-presentacion { background-color: #131b26; border: 1px solid #0dcaf0; border-radius: 16px; box-shadow: 0 10px 30px rgba(13, 202, 240, 0.15); }
        .accent-text { color: #0dcaf0; }
        .section-box { background-color: #0d131d; border-left: 4px solid #0dcaf0; padding: 18px; border-radius: 8px; margin-bottom: 20px; }
        .autor-avatar { width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 4px solid #0dcaf0; box-shadow: 0 0 15px rgba(13, 202, 240, 0.4); }

        @media print {
            body { background-color: #ffffff !important; color: #000000 !important; }
            .card-presentacion { background-color: #ffffff !important; border: 1px solid #000000 !important; color: #000000 !important; box-shadow: none !important; }
            .btn-no-print, .upload-box-no-print { display: none !important; }
            .text-white, .accent-text { color: #000000 !important; }
            .section-box { background-color: #f8f9fa !important; border-left: 4px solid #000000 !important; }
            .autor-avatar { border: 3px solid #000000 !important; box-shadow: none !important; }
        }
    </style>
</head>
<body class="py-5">

<div class="container" style="max-width: 920px;">

    <!-- BARRA DE ACCIONES -->
    <div class="d-flex justify-content-between align-items-center mb-4 btn-no-print">
        <a href="/esc_project/public/" class="btn btn-outline-info btn-sm fw-bold">
            <i class="fa-solid fa-arrow-left me-1"></i> Volver al Inicio
        </a>
        <button onclick="window.print()" class="btn btn-info text-dark fw-bold btn-sm">
            <i class="fa-solid fa-print me-1"></i> Imprimir / Guardar en PDF
        </button>
    </div>

    <?php if (!empty($mensajeExito)): ?>
        <div class="alert alert-success alert-dismissible fade show fw-bold btn-no-print" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i><?= htmlspecialchars($mensajeExito) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- HOJA DE PRESENTACIÓN -->
    <div class="card card-presentacion p-4 p-md-5">

        <!-- LOGO Y EMBLEMA CORPORATIVO -->
        <div class="text-center border-bottom border-secondary pb-4 mb-4">
            <div class="d-flex align-items-center justify-content-center gap-3 mb-2">
                <span class="fa-stack" style="font-size: 2rem;">
                    <i class="fa-solid fa-shield-halved fa-stack-2x text-info"></i>
                    <i class="fa-solid fa-cat fa-stack-1x text-warning" style="transform: translateY(-2px) scale(0.85); text-shadow: 0 0 4px #000;"></i>
                </span>
                <h1 class="fw-bold text-white display-5 m-0">E.S.C.</h1>
            </div>
            <h4 class="fw-bold accent-text mb-1">ENTREGA SEGURA Y CONFIABLE</h4>
            <p class="text-secondary mb-0">Plataforma Web de Comercio Seguro, Custodia Temporal (Escrow) e Inspección Presencial</p>
        </div>

        <!-- SECCIÓN PERFIL DEL AUTOR CON FOTO -->
        <div class="section-box mb-4">
            <h5 class="fw-bold accent-text mb-3"><i class="fa-solid fa-user-gear me-2"></i>Presentación del Desarrollador</h5>
            <div class="row align-items-center g-4">
                <div class="col-md-4 text-center">
                    <img src="<?= htmlspecialchars($fotoUrl) ?>" alt="Foto del Autor" class="autor-avatar mb-2">
                    <div class="fw-bold text-white fs-5 mt-2">Jose Alejandro Cortes</div>
                    <small class="accent-text d-block">Desarrollador de Software</small>
                </div>
                <div class="col-md-8">
                    <p class="text-white mb-2">
                        Estudiante y desarrollador responsable del diseño de arquitectura web, backend MVC y gestión de base de datos de la plataforma <strong>E.S.C. (Entrega Segura y Confiable)</strong>.
                    </p>
                    <ul class="text-white small mb-0">
                        <li><strong>Proyecto:</strong> Sistema E-commerce con Custodia Escrow.</li>
                        <li><strong>Ubicación:</strong> Bogotá D.C., Colombia.</li>
                        <li><strong>Estado del Proyecto:</strong> Desarrollo y entrega final completados.</li>
                    </ul>

                    <!-- FORMULARIO PARA SUBIR/CAMBIAR FOTO -->
                    <div class="mt-3 upload-box-no-print">
                        <form action="/esc_project/public/index.php?url=presentacion" method="POST" enctype="multipart/form-data" class="d-flex gap-2 align-items-center">
                            <input type="file" name="foto_presentacion" class="form-control form-control-sm bg-dark text-white border-secondary" accept="image/*" required>
                            <button type="submit" class="btn btn-outline-info btn-sm fw-bold text-nowrap">
                                <i class="fa-solid fa-camera me-1"></i> Subir Foto
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- FICHA TÉCNICA E INFORMACIÓN ACADÉMICA / INSTITUCIONAL -->
        <div class="section-box">
            <h5 class="fw-bold accent-text mb-3"><i class="fa-solid fa-graduation-cap me-2"></i>Ficha Técnica e Información Académica</h5>
            <div class="row g-3 text-white">
                <div class="col-md-6">
                    <strong>Nombre del Proyecto:</strong> E.S.C. (Entrega Segura y Confiable)
                </div>
                <div class="col-md-6">
                    <strong>Estudiante / Autor:</strong> Jose Alejandro Cortes
                </div>
                <div class="col-md-6">
                    <strong>Institución / Programa:</strong> Desarrollo de Software / Programación Web
                </div>
                <div class="col-md-6">
                    <strong>Asignatura / Módulo:</strong> Proyecto de Programación Web & Base de Datos
                </div>
                <div class="col-md-6">
                    <strong>Ubicación:</strong> Bogotá D.C., Colombia
                </div>
                <div class="col-md-6">
                    <strong>Año lectivo:</strong> 2026
                </div>
                <div class="col-md-12">
                    <strong>Marco Legal & Normativa:</strong> Ley 1581 de 2012 (Protección de Datos Personales)
                </div>
            </div>
        </div>

        <!-- OBJETIVO PRINCIPAL -->
        <div class="section-box">
            <h5 class="fw-bold accent-text mb-2"><i class="fa-solid fa-bullseye me-2"></i>Objetivo General</h5>
            <p class="mb-0 text-white">
                Garantizar la máxima seguridad, transparencia y confianza en las transacciones comerciales entre particulares en Colombia mediante la retención temporal de pagos (Escrow) y la verificación presencial e inspección técnica previa de productos nacionales e importaciones.
            </p>
        </div>

        <!-- ARQUITECTURA TÉCNICA -->
        <div class="section-box">
            <h5 class="fw-bold accent-text mb-3"><i class="fa-solid fa-layer-group me-2"></i>Tecnologías y Arquitectura</h5>
            <ul class="mb-0 text-white">
                <li><strong>Patrón de Diseño:</strong> Modelo-Vista-Controlador (MVC) en PHP nativo.</li>
                <li><strong>Base de Datos:</strong> MySQL (`esc_db`) mediante conexiones seguras PDO con encriptación BCRYPT.</li>
                <li><strong>Interfaz & Estilos:</strong> HTML5, CSS3, JavaScript, Bootstrap 5 y FontAwesome Icons.</li>
                <li><strong>Seguridad:</strong> Validaciones de contraseñas por Expresión Regular (`/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/m`).</li>
            </ul>
        </div>

        <!-- PIE DE PÁGINA -->
        <div class="text-center text-secondary small border-top border-secondary pt-3 mt-3">
            E.S.C. - Sistema Verificado &copy; 2026. Todos los derechos reservados.
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>