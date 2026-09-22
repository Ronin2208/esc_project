<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - E.S.C.</title>
    <link rel="stylesheet" href="/esc_project/public/css/style.css">
</head>
<body>

    <header>
        <div class="header-container">
            <a href="/esc_project/public/" class="logo">
                <span>E.S.C.</span>
                <span class="logo-badge">Protegido</span>
            </a>
            <nav>
                <ul>
                    <li><a href="/esc_project/public/">Inicio</a></li>
                    <li><a href="/esc_project/public/auth/registro" class="btn btn-outline" style="color:#fff; border-color:rgba(255,255,255,0.3);">Registrarse</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="form-container" style="max-width: 420px; margin: 2rem auto; background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <h2 style="text-align: center; margin-bottom: 1.5rem; color: var(--primary-color);">Iniciar Sesión</h2>

            <?php if (!empty($error)): ?>
                <div style="background-color: #fee2e2; color: #991b1b; padding: 0.75rem; border-radius: 6px; margin-bottom: 1rem; text-align: center; font-size: 0.9rem;">
                    <?= $error; ?>
                </div>
            <?php endif; ?>

            <form action="/esc_project/public/auth/login" method="POST">
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="email" style="display:block; margin-bottom: 0.5rem;">Correo Electrónico</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="ejemplo@correo.com" required style="width:100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="password" style="display:block; margin-bottom: 0.5rem;">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required style="width:100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem; padding: 0.75rem;">Ingresar a E.S.C.</button>
            </form>

            <p style="text-align: center; margin-top: 1.5rem; font-size: 0.9rem; color: var(--text-muted);">
                ¿Aún no tienes una cuenta? <a href="/esc_project/public/auth/registro" style="color: var(--accent-color); font-weight: 600;">Regístrate aquí</a>
            </p>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> <strong>E.S.C. (Entrega Segura y Confiable)</strong>.</p>
    </footer>

</body>
</html>