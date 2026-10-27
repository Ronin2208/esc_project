<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura Digital <?= htmlspecialchars($factura['numero']) ?> - E.S.C.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; color: #212529; font-family: 'Segoe UI', Arial, sans-serif; }
        .invoice-box { max-width: 800px; margin: 30px auto; padding: 30px; background: #fff; border: 1px solid #dee2e6; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        @media print {
            .no-print { display: none !important; }
            body { background: #fff; }
            .invoice-box { border: none; box-shadow: none; margin: 0; padding: 0; width: 100%; }
        }
    </style>
</head>
<body>

<div class="container no-print text-center my-4">
    <button onclick="window.print();" class="btn btn-primary fw-bold btn-lg shadow-sm">
        <i class="fa-solid fa-print me-2"></i> Imprimir / Descargar Factura PDF
    </button>
    <a href="/esc_project/public/index.php?url=ventas" class="btn btn-outline-secondary btn-lg ms-2">Volver al Panel</a>
</div>

<div class="invoice-box">
    <!-- Encabezado de la Factura -->
    <div class="row align-items-center mb-4">
        <div class="col-6">
            <h2 class="fw-bold text-primary mb-0"><i class="fa-solid fa-shield-halved text-info"></i> E.S.C.</h2>
            <small class="text-muted">Entrega Segura y Confiable S.A.S.</small><br>
            <small class="text-muted">NIT: 901.482.930-1 | Bogotá, Colombia</small>
        </div>
        <div class="col-6 text-end">
            <h4 class="fw-bold text-dark mb-0">FACTURA DIGITAL</h4>
            <span class="badge bg-primary fs-6"><?= htmlspecialchars($factura['numero']) ?></span>
            <div class="text-muted small mt-1">Fecha de Emisión: <?= htmlspecialchars($factura['fecha']) ?></div>
        </div>
    </div>

    <hr>

    <!-- Datos del Vendedor y Comprador -->
    <div class="row my-4">
        <div class="col-6">
            <h6 class="fw-bold text-uppercase text-secondary small">Vendedor (Titular)</h6>
            <div class="fw-bold"><?= htmlspecialchars($factura['vendedor']) ?></div>
            <div class="small text-muted">Cuenta Verificada E.S.C.</div>
        </div>
        <div class="col-6">
            <h6 class="fw-bold text-uppercase text-secondary small">Comprador</h6>
            <div class="fw-bold"><?= htmlspecialchars($factura['comprador']) ?></div>
            <div class="small text-muted"><?= htmlspecialchars($factura['email_comprador']) ?></div>
        </div>
    </div>

    <!-- Punto de Inspección -->
    <div class="alert alert-light border border-info rounded p-2 mb-4 small">
        <i class="fa-solid fa-location-dot text-info me-1"></i> <strong>Punto de Inspección y Custodia:</strong> <?= htmlspecialchars($factura['inspeccion_punto']) ?>
    </div>

    <!-- Detalle de Productos -->
    <table class="table table-bordered mb-4">
        <thead class="table-light">
            <tr>
                <th>Descripción del Producto</th>
                <th class="text-center">Cant.</th>
                <th class="text-end">Precio Unitario</th>
                <th class="text-end">Total Bruto</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= htmlspecialchars($factura['producto']) ?></td>
                <td class="text-center"><?= $factura['unidades'] ?></td>
                <td class="text-end">$<?= number_format($factura['precio_unitario'], 0, ',', '.') ?> COP</td>
                <td class="text-end">$<?= number_format($factura['precio_unitario'] * $factura['unidades'], 0, ',', '.') ?> COP</td>
            </tr>
        </tbody>
    </table>

    <!-- Totales y Deducción E.S.C. -->
    <div class="row justify-content-end">
        <div class="col-6">
            <table class="table table-sm table-borderless">
                <tr>
                    <td class="text-end text-muted">Subtotal Venta Bruta:</td>
                    <td class="text-end fw-bold">$<?= number_format($factura['precio_unitario'], 0, ',', '.') ?> COP</td>
                </tr>
                <tr>
                    <td class="text-end text-muted">Comisión de Garantía y Custodia E.S.C. (5%):</td>
                    <td class="text-end text-danger">-$<?= number_format($factura['comision_escrow'], 0, ',', '.') ?> COP</td>
                </tr>
                <tr class="border-top">
                    <td class="text-end fw-bold fs-5 text-dark">Monto Neta Desembolsado:</td>
                    <td class="text-end fw-bold fs-5 text-success">$<?= number_format($factura['total_recibido'], 0, ',', '.') ?> COP</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Estado del Pago Escrow -->
    <div class="mt-4 p-3 bg-light rounded d-flex justify-content-between align-items-center border">
        <div>
            <span class="text-muted small d-block">Estado de la transacción:</span>
            <strong class="text-success"><i class="fa-solid fa-lock me-1"></i> <?= htmlspecialchars($factura['estado_pago']) ?></strong>
        </div>
        <div class="text-end">
            <small class="text-muted d-block">Comprobante verificado electrónicamente por E.S.C.</small>
        </div>
    </div>
</div>

</body>
</html>