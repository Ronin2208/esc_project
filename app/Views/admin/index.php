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
    <title>Panel de Administración E.S.C.</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #0b0e14; color: #ffffff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; }
        .card-panel { background-color: #131b26; border: 1px solid #1e2d3d; border-radius: 12px; }
        .table-custom { color: #ffffff; }
        .table-custom th { background-color: #0d131d; color: #0dcaf0; border-bottom: 1px solid #1e2d3d; font-weight: 600; }
        .table-custom td { background-color: #ffffff; color: #000000; border-bottom: 1px solid #e2e8f0; font-weight: 600; vertical-align: middle; }
        .badge-status-disp { background-color: #198754; color: #fff; font-weight: bold; padding: 6px 12px; border-radius: 6px; }
        .badge-status-vend { background-color: #dc3545; color: #fff; font-weight: bold; padding: 6px 12px; border-radius: 6px; }
    </style>
</head>
<body class="py-4">

<div class="container" style="max-width: 1100px;">

    <!-- ENCABEZADO -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-white m-0">Registro de Productos y Transacciones</h2>
            <p class="text-secondary small m-0">Gestión de inventario añadido, ventas con custodia y análisis de demandas de búsqueda.</p>
        </div>
        <div class="d-flex gap-2">
            <span class="badge bg-info text-dark font-monospace fs-6 px-3 py-2 fw-bold d-flex align-items-center">
                PROPIETARIO / ADMINISTRADOR E.S.C.
            </span>
            <a href="/esc_project/public/" class="btn btn-outline-light btn-sm fw-bold ms-2">
                <i class="fa-solid fa-arrow-left me-1"></i> Inicio
            </a>
        </div>
    </div>

    <div class="row g-4">
        
        <!-- TABLA IZQUIERDA: PRODUCTOS AÑADIDOS -->
        <div class="col-lg-7">
            <div class="card card-panel p-4 shadow-sm h-100">
                <h4 class="fw-bold text-white mb-3 d-flex align-items-center gap-2">
                    <i class="fa-solid fa-boxes-packing text-primary"></i> Productos Añadidos
                </h4>
                
                <div class="table-responsive">
                    <table class="table table-custom align-middle m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Fecha</th>
                                <th class="text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productosLista as $index => $item): ?>
                                <tr>
                                    <td class="text-secondary font-monospace">#10<?= $item['id'] ?? ($index + 1) ?></td>
                                    <td class="fw-bold text-dark"><?= htmlspecialchars($item['nombre'] ?? 'Producto Verificado') ?></td>
                                    <td class="text-success fw-bold">$<?= htmlspecialchars($item['precio'] ?? '0') ?></td>
                                    <td class="text-secondary small"><?= htmlspecialchars($item['fecha'] ?? date('Y-m-d')) ?></td>
                                    <td class="text-center">
                                        <?php if (($item['estado'] ?? 'Disponible') === 'Vendido'): ?>
                                            <span class="badge-status-vend">Vendido</span>
                                        <?php else: ?>
                                            <span class="badge-status-disp">Disponible</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TABLA DERECHA: LO MÁS BUSCADO EN E.S.C. -->
        <div class="col-lg-5">
            <div class="card card-panel p-4 shadow-sm h-100">
                <h4 class="fw-bold text-white mb-3 d-flex align-items-center gap-2">
                    <i class="fa-solid fa-chart-line text-warning"></i> Lo Más Buscado en E.S.C.
                </h4>
                
                <div class="table-responsive">
                    <table class="table table-custom align-middle m-0">
                        <thead>
                            <tr>
                                <th>Término / Categoría</th>
                                <th class="text-center">Búsquedas</th>
                                <th class="text-center">Tendencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($masBuscados as $busc): ?>
                                <tr>
                                    <td class="fw-bold text-dark small"><?= htmlspecialchars($busc['categoria']) ?></td>
                                    <td class="text-center fw-bold text-dark"><?= htmlspecialchars($busc['busquedas']) ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-primary px-2 py-1"><?= htmlspecialchars($busc['tendencia']) ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>