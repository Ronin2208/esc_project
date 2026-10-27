<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario - E.S.C.</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #0b0e14; color: #ffffff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; }
        .card-custom { background-color: #131b26; border: 1px solid #1e2d3d; border-radius: 12px; }
        .form-control, .form-select { background-color: #0d131d !important; color: #ffffff !important; border-color: #1e2d3d !important; }
        .form-control:focus, .form-select:focus { border-color: #0dcaf0 !important; box-shadow: 0 0 8px rgba(13, 202, 240, 0.3) !important; }
        .regex-badge { font-size: 0.8rem; border-radius: 4px; padding: 4px 8px; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center py-5">

<div class="container" style="max-width: 500px;">
    <div class="card card-custom p-4 p-md-5 shadow-lg">

        <div class="text-center mb-4">
            <a href="/esc_project/public/" class="text-decoration-none">
                <h3 class="fw-bold text-primary mb-1 d-flex align-items-center justify-content-center gap-2">
                    <i class="fa-solid fa-shield-halved text-info"></i> E.S.C.
                </h3>
            </a>
            <h5 class="fw-bold text-white">Crear Nueva Cuenta</h5>
            <p class="text-secondary small">Únete a la plataforma segura de compras y ventas</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show small fw-bold" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i><?= htmlspecialchars($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="/esc_project/public/index.php?url=auth/registrar" method="POST" id="formRegistro">
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-light">Nombre Completo</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ej. Jose Alejandro Cortes" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-light">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" placeholder="nombre@correo.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-light">Contraseña</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                    <button type="button" class="btn btn-outline-secondary text-light" id="btnTogglePass">
                        <i class="fa-solid fa-eye" id="iconEye"></i>
                    </button>
                </div>
                
                <!-- Requisitos de la contraseña indicados visualmente -->
                <div class="mt-2 text-secondary small">
                    <small class="d-block mb-1 text-info"><i class="fa-solid fa-lock me-1"></i>Requisitos de la contraseña:</small>
                    <div class="d-flex flex-wrap gap-1">
                        <span id="reqLength" class="badge bg-dark text-secondary border border-secondary regex-badge">Min. 8 caracteres</span>
                        <span id="reqUpper" class="badge bg-dark text-secondary border border-secondary regex-badge">1 Mayúscula</span>
                        <span id="reqLower" class="badge bg-dark text-secondary border border-secondary regex-badge">1 Minúscula</span>
                        <span id="reqNum" class="badge bg-dark text-secondary border border-secondary regex-badge">1 Número</span>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-light">Rol en la Plataforma</label>
                <select name="rol" class="form-select">
                    <option value="Comprador y Vendedor">Comprador y Vendedor</option>
                    <option value="Solo Comprador">Solo Comprador</option>
                    <option value="Solo Vendedor">Solo Vendedor</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm" id="btnSubmit">
                <i class="fa-solid fa-user-plus me-1"></i> Registrarse en E.S.C.
            </button>
        </form>

        <div class="text-center mt-4 border-top border-secondary pt-3 small text-secondary">
            ¿Ya tienes una cuenta? <a href="/esc_project/public/" class="text-info text-decoration-none fw-bold">Volver al Inicio</a>
        </div>

    </div>
</div>

<script>
const passwordInput = document.getElementById('password');
const reqLength = document.getElementById('reqLength');
const reqUpper = document.getElementById('reqUpper');
const reqLower = document.getElementById('reqLower');
const reqNum = document.getElementById('reqNum');

// Validación en tiempo real con Regex
passwordInput.addEventListener('input', function() {
    const val = this.value;

    // Comprobaciones por separado para guiar al usuario
    const hasLength = val.length >= 8;
    const hasUpper = /[A-Z]/.test(val);
    const hasLower = /[a-z]/.test(val);
    const hasNum = /\d/.test(val);

    updateBadge(reqLength, hasLength);
    updateBadge(reqUpper, hasUpper);
    updateBadge(reqLower, hasLower);
    updateBadge(reqNum, hasNum);
});

function updateBadge(element, isValid) {
    if (isValid) {
        element.classList.remove('bg-dark', 'text-secondary', 'border-secondary');
        element.classList.add('bg-success', 'text-white', 'border-success');
    } else {
        element.classList.remove('bg-success', 'text-white', 'border-success');
        element.classList.add('bg-dark', 'text-secondary', 'border-secondary');
    }
}

// Ocultar/Mostrar Contraseña
document.getElementById('btnTogglePass').addEventListener('click', function() {
    const icon = document.getElementById('iconEye');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});
</script>

</body>
</html>