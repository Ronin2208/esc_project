<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - E.S.C.</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #0b0e14; color: #ffffff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; }
        .card-custom { background-color: #131b26; border: 1px solid #1e2d3d; border-radius: 12px; }
        .form-control { background-color: #0d131d !important; color: #ffffff !important; border-color: #1e2d3d !important; }
        .form-control:focus { border-color: #0dcaf0 !important; box-shadow: 0 0 8px rgba(13, 202, 240, 0.3) !important; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center py-5">

<div class="container" style="max-width: 450px;">
    <div class="card card-custom p-4 p-md-5 shadow-lg">

        <div class="text-center mb-4">
            <a href="/esc_project/public/" class="text-decoration-none">
                <h3 class="fw-bold text-primary mb-1 d-flex align-items-center justify-content-center gap-2">
                    <i class="fa-solid fa-shield-halved text-info"></i> E.S.C.
                </h3>
            </a>
            <h5 class="fw-bold text-white">Iniciar Sesión</h5>
            <p class="text-secondary small">Ingresa tus credenciales para acceder</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show small fw-bold" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i><?= htmlspecialchars($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="/esc_project/public/index.php?url=auth/login" method="POST">
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-light">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" placeholder="nombre@correo.com" required>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-light">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">
                <i class="fa-solid fa-right-to-bracket me-1"></i> Entrar a E.S.C.
            </button>
        </form>

        <div class="text-center mt-4 border-top border-secondary pt-3 small text-secondary">
            ¿No tienes cuenta? <a href="/esc_project/public/index.php?url=auth/registro" class="text-info text-decoration-none fw-bold">Regístrate aquí</a>
        </div>

    </div>
</div>

</body>
</html>