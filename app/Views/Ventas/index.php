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
    <title>Panel de Ventas, Custodia y Facturación - E.S.C.</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #0b0e14; color: #ffffff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; }
        .card-custom { background-color: #131b26; border: 1px solid #1e2d3d; border-radius: 12px; }
        .metric-card { background-color: #131b26; border: 1px solid #1e2d3d; border-radius: 12px; padding: 20px; }
        .table-custom { color: #ffffff; }
        .table-custom th { background-color: #0d131d; color: #0dcaf0; border-bottom: 1px solid #1e2d3d; font-weight: 600; padding: 12px; }
        .table-custom td { background-color: #ffffff; color: #0f172a; border-bottom: 1px solid #e2e8f0; font-weight: 600; vertical-align: middle; padding: 12px; }
        .badge-liberado { background-color: #198754; color: #fff; font-weight: bold; padding: 6px 12px; border-radius: 6px; }
        .badge-retenido { background-color: #ffc107; color: #000; font-weight: bold; padding: 6px 12px; border-radius: 6px; }
    </style>
</head>
<body class="py-4">

<div class="container" style="max-width: 1150px;">

    <!-- ENCABEZADO -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-white m-0 d-flex align-items-center gap-2">
                <i class="fa-solid fa-chart-line text-success"></i> Panel de Ventas y Facturación
            </h2>
            <p class="text-secondary small m-0">Resumen de ingresos, compradores, verificación de entregas y comprobantes descargables.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="/esc_project/public/" class="btn btn-outline-light btn-sm fw-bold">
                <i class="fa-solid fa-house me-1"></i> Inicio
            </a>
            <a href="/esc_project/public/index.php?url=producto/crear" class="btn btn-success btn-sm fw-bold">
                <i class="fa-solid fa-plus me-1"></i> Nuevo Producto
            </a>
        </div>
    </div>

    <!-- TARJETAS DE MÉTRICAS -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="metric-card border-success">
                <small class="text-secondary fw-bold text-uppercase d-block mb-1">GANANCIA NETA TOTAL</small>
                <h3 class="fw-bold text-success m-0">$2.535.000 <small class="fs-6 text-muted">COP</small></h3>
                <small class="text-success"><i class="fa-solid fa-circle-check me-1"></i> Fondos liberados por Custodia Escrow</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="metric-card border-primary">
                <small class="text-secondary fw-bold text-uppercase d-block mb-1">VENTAS BRUTAS TOTALES</small>
                <h3 class="fw-bold text-primary m-0">$2.700.000 <small class="fs-6 text-muted">COP</small></h3>
                <small class="text-secondary">Antes de deducción por comisión E.S.C.</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="metric-card border-info">
                <small class="text-secondary fw-bold text-uppercase d-block mb-1">ARTÍCULOS VENDIDOS</small>
                <h3 class="fw-bold text-info m-0">3 <small class="fs-6 text-muted">Unidades</small></h3>
                <small class="text-info"><i class="fa-solid fa-shield-halved me-1"></i> Con verificación de entregas completadas</small>
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        <!-- TABLA PRINCIPAL: HISTORIAL DE COMPRADORES, ENTREGAS Y FACTURAS -->
        <div class="col-lg-8">
            <div class="card card-custom p-4 shadow-sm h-100">
                <h5 class="fw-bold text-white mb-3 d-flex align-items-center gap-2">
                    <i class="fa-solid fa-receipt text-warning"></i> Historial de Ventas y Compradores
                </h5>
                
                <div class="table-responsive">
                    <table class="table table-custom align-middle m-0">
                        <thead>
                            <tr>
                                <th>Factura / Fecha</th>
                                <th>Producto / Comprador</th>
                                <th>Ganancia Neta</th>
                                <th class="text-center">Estado Entrega</th>
                                <th class="text-center">Comprobante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ventasHistorial as $v): ?>
                                <tr>
                                    <td>
                                        <div class="fw-bold text-primary small"><?= htmlspecialchars($v['factura_id']) ?></div>
                                        <div class="text-muted small"><?= htmlspecialchars($v['fecha']) ?></div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= htmlspecialchars($v['producto']) ?></div>
                                        <div class="text-muted small"><i class="fa-solid fa-user me-1"></i><?= htmlspecialchars($v['comprador']) ?> (<?= htmlspecialchars($v['ciudad']) ?>)</div>
                                    </td>
                                    <td>
                                        <div class="text-success fw-bold"><?= htmlspecialchars($v['ganancia_neta']) ?></div>
                                        <div class="text-muted small">Comisión: <?= htmlspecialchars($v['comision']) ?></div>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($v['custodia'] === 'Liberada'): ?>
                                            <span class="badge-liberado"><i class="fa-solid fa-check me-1"></i><?= htmlspecialchars($v['estado']) ?></span>
                                        <?php else: ?>
                                            <span class="badge-retenido"><i class="fa-solid fa-clock me-1"></i><?= htmlspecialchars($v['estado']) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <button onclick="window.print()" class="btn btn-outline-info btn-sm fw-bold" title="Descargar/Imprimir Factura">
                                            <i class="fa-solid fa-file-invoice me-1"></i> Factura
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TABLA SECUNDARIA: PRODUCTOS MÁS VENDIDOS -->
        <div class="col-lg-4">
            <div class="card card-custom p-4 shadow-sm h-100">
                <h5 class="fw-bold text-white mb-3 d-flex align-items-center gap-2">
                    <i class="fa-solid fa-fire text-danger"></i> Productos Más Vendidos
                </h5>

                <div class="d-flex flex-column gap-3">
                    <?php foreach ($topVendidos as $i => $top): ?>
                        <div class="p-3 bg-dark border border-secondary rounded d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-primary me-2">#<?= $i + 1 ?></span>
                                <strong class="text-white small"><?= htmlspecialchars($top['nombre']) ?></strong>
                                <div class="text-muted small mt-1"><?= $top['unidades'] ?> unidades vendidas</div>
                            </div>
                            <span class="text-success fw-bold small"><?= $top['total'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>