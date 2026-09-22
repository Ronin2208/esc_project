<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - E.S.C.</title>
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
                    <li><a href="/esc_project/public/auth/login" class="btn btn-primary">Iniciar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="form-container" style="max-width: 500px; margin: 2rem auto; background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <h2 style="text-align: center; margin-bottom: 0.5rem; color: var(--primary-color);">Crear Cuenta</h2>
            <p style="text-align: center; margin-bottom: 1.5rem; color: var(--text-muted); font-size: 0.9rem;">
                Registra tus datos para comprar o vender de forma segura.
            </p>

            <?php if (!empty($error)): ?>
                <div style="background-color: #fee2e2; color: #991b1b; padding: 0.75rem; border-radius: 6px; margin-bottom: 1rem; text-align: center; font-size: 0.9rem;">
                    <?= $error; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($exito)): ?>
                <div style="background-color: #d1fae5; color: #065f46; padding: 0.75rem; border-radius: 6px; margin-bottom: 1rem; text-align: center; font-size: 0.9rem;">
                    <?= $exito; ?>
                </div>
            <?php endif; ?>

            <form action="/esc_project/public/auth/registro" method="POST">
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required style="width:100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" class="form-control" required style="width:100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" required style="width:100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div>
                        <label for="telefono">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" class="form-control" required style="width:100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
                    </div>
                    <div>
                        <label for="documento">Documento Identidad</label>
                        <input type="text" id="documento" name="documento" class="form-control" required style="width:100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="rol">Tipo de Perfil</label>
                    <select id="rol" name="rol" class="form-control" required style="width:100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="comprador">Comprador</option>
                        <option value="vendedor">Vendedor</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem; padding: 0.75rem;">Completar Registro</button>
            </form>

            <p style="text-align: center; margin-top: 1.5rem; font-size: 0.9rem; color: var(--text-muted);">
                ¿Ya tienes cuenta? <a href="/esc_project/public/auth/login" style="color: var(--accent-color); font-weight: 600;">Inicia sesión</a>
            </p>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> <strong>E.S.C. (Entrega Segura y Confiable)</strong>.</p>
    </footer>

</body>
</html>