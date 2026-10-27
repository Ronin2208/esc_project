<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estado de Transacción - E.S.C.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #0b0e14; color: #e2e8f0; font-family: 'Segoe UI', sans-serif; }
        .card-custom { background-color: #131b26; border: 1px solid #1e2d3d; border-radius: 12px; }
        .status-badge { font-size: 0.9rem; padding: 8px 16px; border-radius: 20px; }
    </style>
</head>
<body class="py-5">

<div class="container" style="max-width: 700px;">
    <div class="card card-custom p-4 text-center shadow">
        <i class="fa-solid fa-circle-check text-success display-1 mb-3"></i>
        <h3 class="fw-bold text-white mb-2">¡Pago en Custodia Registrado!</h3>
        <p class="text-secondary mb-4">El dinero ha sido retenido de forma segura en la plataforma E.S.C. Guía de Orden #ESC-2026-9812.</p>

        <!-- Estado en Tiempo Real -->
        <div class="bg-dark p-4 rounded text-start border border-secondary mb-4">
            <h6 class="fw-bold text-white mb-3"><i class="fa-solid fa-clock-rotate-left text-info me-2"></i>Seguimiento del Estado de la Compra:</h6>
            
            <div class="d-flex align-items-center gap-3 mb-3">
                <i class="fa-solid fa-circle-check text-success fs-5"></i>
                <div>
                    <strong class="text-white d-block">1. Pago en Custodia Confirmado</strong>
                    <small class="text-muted">El vendedor fue notificado para enviar el producto al punto E.S.C.</small>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3 mb-3 opacity-75">
                <i class="fa-solid fa-spinner text-warning fs-5 fa-spin"></i>
                <div>
                    <strong class="text-white d-block">2. Inspección Técnica Presencial (En Curso)</strong>
                    <small class="text-muted">Revisión física del estado en tienda aliada.</small>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3 opacity-50">
                <i class="fa-solid fa-truck-fast text-secondary fs-5"></i>
                <div>
                    <strong class="text-white d-block">3. Envío al Comprador (Servientrega / Coordinadora)</strong>
                    <small class="text-muted">Guía nacional asignada.</small>
                </div>
            </div>
        </div>

        <a href="/esc_project/public/" class="btn btn-primary fw-bold px-4">Volver al Inicio</a>
    </div>
</div>

</body>
</html>