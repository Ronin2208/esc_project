<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'E.S.C.'; ?></title>
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
                    <li><a href="/esc_project/public/" class="active">Inicio</a></li>
                    <li><a href="/esc_project/public/index.php?url=usuario">Usuarios</a></li>
                    
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <li>
                            <span style="color: #cbd5e1; font-size: 0.9rem;">
                                Hola, <strong><?= htmlspecialchars($_SESSION['usuario_nombre']); ?></strong> (<?= ucfirst($_SESSION['usuario_rol']); ?>)
                            </span>
                        </li>
                        <li>
                            <a href="/esc_project/public/index.php?url=auth/logout" class="btn btn-outline" style="color: #fff; border-color: rgba(255,255,255,0.3); padding: 0.4rem 0.8rem;">Cerrar Sesión</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="/esc_project/public/index.php?url=auth/login" class="btn btn-outline" style="color: #fff; border-color: rgba(255,255,255,0.3);">Iniciar Sesión</a>
                        </li>
                        <li>
                            <a href="/esc_project/public/index.php?url=auth/registro" class="btn btn-primary">Registrarse</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero-card">
            <h2>Comercio Electrónico Local 100% Seguro</h2>
            <p><?= $descripcion ?? 'Plataforma de intermediación de confianza (Escrow).'; ?></p>
            <div style="display: flex; justify-content: center; gap: 1rem; margin-top: 1.5rem;">
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <a href="#" class="btn btn-primary">Crear Transacción Segura</a>
                <?php else: ?>
                    <a href="/esc_project/public/index.php?url=auth/registro" class="btn btn-primary">Registrarme Ahora</a>
                    <a href="/esc_project/public/index.php?url=auth/login" class="btn btn-outline">Iniciar Sesión</a>
                <?php endif; ?>
            </div>
        </section>

        <section>
            <h3 style="margin-bottom: 1.5rem; color: var(--primary-color);">Estado de Custodia en Tiempo Real</h3>
            <div class="grid-cards">
                <div class="card">
                    <span class="status-badge status-custodia">● Pago en Custodia</span>
                    <h4 class="card-title" style="margin-top: 0.8rem;">Laptop HP Pavilion 15"</h4>
                    <p class="card-price">$450.00 USD</p>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">El dinero se mantendrá seguro hasta que confirmes la entrega.</p>
                </div>

                <div class="card">
                    <span class="status-badge status-liberado">✓ Dinero Liberado</span>
                    <h4 class="card-title" style="margin-top: 0.8rem;">Servicio Mantenimiento PC</h4>
                    <p class="card-price">$35.00 USD</p>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Servicio entregado a satisfacción. Transacción finalizada.</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> <strong>E.S.C. (Entrega Segura y Confiable)</strong>. Todos los derechos reservados.</p>
    </footer>

</body>
</html>