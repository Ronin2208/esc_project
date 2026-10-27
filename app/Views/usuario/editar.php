<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $titulo; ?></title>
    <link rel="stylesheet" href="/esc_project/public/css/style.css">
</head>
<body>
    <main style="max-width: 500px; margin: 2rem auto; padding: 1rem;">
        <h2>Editar Usuario #<?= $usuario['id']; ?></h2>
        
        <form action="/esc_project/public/usuario/actualizar/<?= $usuario['id']; ?>" method="POST">
            <div style="margin-bottom: 1rem;">
                <label>Nombre Completo:</label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']); ?>" required style="width: 100%; padding: 0.5rem;">
            </div>

            <div style="margin-bottom: 1rem;">
                <label>Correo Electrónico:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']); ?>" required style="width: 100%; padding: 0.5rem;">
            </div>

            <div style="margin-bottom: 1rem;">
                <label>Teléfono:</label>
                <input type="text" name="telefono" value="<?= htmlspecialchars($usuario['telefono']); ?>" required style="width: 100%; padding: 0.5rem;">
            </div>

            <div style="margin-bottom: 1rem;">
                <label>Documento de Identidad:</label>
                <input type="text" name="documento" value="<?= htmlspecialchars($usuario['documento_identidad']); ?>" required style="width: 100%; padding: 0.5rem;">
            </div>

            <div style="margin-bottom: 1rem;">
                <label>Rol:</label>
                <select name="rol" style="width: 100%; padding: 0.5rem;">
                    <option value="comprador" <?= $usuario['rol'] === 'comprador' ? 'selected' : ''; ?>>Comprador</option>
                    <option value="vendedor" <?= $usuario['rol'] === 'vendedor' ? 'selected' : ''; ?>>Vendedor</option>
                    <option value="administrador" <?= $usuario['rol'] === 'administrador' ? 'selected' : ''; ?>>Administrador</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Guardar Cambios</button>
            <a href="/esc_project/public/usuario" style="display: block; text-align: center; margin-top: 1rem; color: #ccc;">Cancelar</a>
        </form>
    </main>
</body>
</html>