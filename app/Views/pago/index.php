<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pasarela Escrow Segura - E.S.C.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #0b0e14; color: #e2e8f0; font-family: 'Segoe UI', sans-serif; }
        .card-custom { background-color: #131b26; border: 1px solid #1e2d3d; border-radius: 12px; }
        .payment-option { background-color: #0d131d; border: 1px solid #1e2d3d; border-radius: 8px; padding: 12px; cursor: pointer; transition: all 0.2s; }
        .payment-option:hover { border-color: #0d6efd; background-color: #162232; }
    </style>
</head>
<body class="py-4">

<div class="container" style="max-width: 800px;">
    <div class="card card-custom p-4 shadow mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold text-white m-0"><i class="fa-solid fa-vault text-warning me-2"></i>Pago Seguro en Custodia (Escrow)</h4>
            <span class="badge bg-success"><i class="fa-solid fa-lock me-1"></i> SSL 256-Bit Cifrado</span>
        </div>

        <?php if ($productoSeleccionado): ?>
            <div class="bg-dark p-3 rounded mb-4 border border-secondary d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold text-white mb-1"><?= htmlspecialchars($productoSeleccionado['nombre']) ?></h5>
                    <p class="text-secondary small mb-0"><?= htmlspecialchars($productoSeleccionado['descripcion']) ?></p>
                </div>
                <div class="text-end">
                    <span class="text-muted small">Total Retenido:</span>
                    <h4 class="text-success fw-bold m-0">$<?= htmlspecialchars($productoSeleccionado['precio']) ?> COP</h4>
                </div>
            </div>

            <h6 class="fw-bold text-white mb-3">Selecciona tu Método de Pago en Colombia:</h6>

            <form action="/esc_project/public/index.php?url=pago/procesar" method="POST">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="payment-option d-flex align-items-center gap-3 w-100">
                            <input type="radio" name="metodo" value="pse" checked>
                            <i class="fa-solid fa-building-columns text-info fs-4"></i>
                            <div>
                                <strong class="text-white d-block">PSE (Débito Bancario)</strong>
                                <small class="text-muted">Bancolombia, Davivienda, Nequi, etc.</small>
                            </div>
                        </label>
                    </div>

                    <div class="col-md-6">
                        <label class="payment-option d-flex align-items-center gap-3 w-100">
                            <input type="radio" name="metodo" value="nequi">
                            <i class="fa-solid fa-mobile-screen text-warning fs-4"></i>
                            <div>
                                <strong class="text-white d-block">Nequi / Daviplata</strong>
                                <small class="text-muted">Transferencia directa en custodia</small>
                            </div>
                        </label>
                    </div>

                    <div class="col-md-6">
                        <label class="payment-option d-flex align-items-center gap-3 w-100">
                            <input type="radio" name="metodo" value="tarjeta">
                            <i class="fa-solid fa-credit-card text-primary fs-4"></i>
                            <div>
                                <strong class="text-white d-block">Tarjeta de Crédito</strong>
                                <small class="text-muted">Visa, Mastercard, American Express</small>
                            </div>
                        </label>
                    </div>

                    <div class="col-md-6">
                        <label class="payment-option d-flex align-items-center gap-3 w-100">
                            <input type="radio" name="metodo" value="efecty">
                            <i class="fa-solid fa-money-bill-transfer text-success fs-4"></i>
                            <div>
                                <strong class="text-white d-block">Efecty / Baloto</strong>
                                <small class="text-muted">Pago en efectivo en convenio</small>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="alert alert-info small mb-4">
                    <i class="fa-solid fa-circle-info me-2"></i>Tu dinero NO se entregará al vendedor hasta que recibas el paquete en tus manos y confirmes que el producto funciona correctamente.
                </div>

                <button type="submit" class="btn btn-primary fw-bold w-100 py-3 fs-5">
                    <i class="fa-solid fa-shield-halved me-2"></i> Confirmar y Retener Dinero en Custodia
                </button>
            </form>
        <?php else: ?>
            <div class="alert alert-danger">Producto no seleccionado.</div>
            <a href="/esc_project/public/" class="btn btn-primary">Volver al Catálogo</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>