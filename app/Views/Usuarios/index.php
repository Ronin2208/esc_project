<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulo CRUD Usuarios</title>
</head>
<body style="background: #111; color: #fff; font-family: sans-serif; padding: 2rem;">
    <h1>¡El CRUD de Usuarios cargó con éxito!</h1>
    <p>Lista de usuarios registrados:</p>

    <ul>
        <?php foreach ($usuarios as $u): ?>
            <li>ID: <?= $u['id']; ?> | Nombre: <?= $u['nombre']; ?> | Email: <?= $u['email']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>