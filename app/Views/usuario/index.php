<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $titulo; ?></title>
    <link rel="stylesheet" href="/esc_project/public/css/style.css">
</head>
<body style="background: #0f172a; color: #fff; font-family: sans-serif;">

    <main style="max-width: 500px; margin: 3rem auto; padding: 2rem; background: #1e293b; border-radius: 8px; border: 1px solid #334155;">
        <h2 style="color: #38bdf8;">Publicar Producto</h2>
        <p style="color: #94a3b8; font-size: 0.9rem;">Sube un producto para ponerlo a la venta en la plataforma.</p>

        <form action="/esc_project/public/index.php?url=producto/guardar" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1.5rem;">
            
            <div>
                <label>Nombre:</label>
                <input type="text" name="nombre" required style="width: 100%; padding: 0.5rem; border-radius: 4px; border: 1px solid #334155; background: #0f172a; color: #fff; margin-top: 0.3rem;">
            </div>

            <div>
                <label>Descripción:</label>
                <textarea name="descripcion" rows="3" required style="width: 100%; padding: 0.5rem; border-radius: 4px; border: 1px solid #334155; background: #0f172a; color: #fff; margin-top: 0.3rem;"></textarea>
            </div>

            <div style="display: flex; gap: 1rem;">
                <div style="flex: 1;">
                    <label>Precio Normal ($):</label>
                    <input type="number" step="0.01" name="precio" required style="width: 100%; padding: 0.5rem; border-radius: 4px; border: 1px solid #334155; background: #0f172a; color: #fff; margin-top: 0.3rem;">
                </div>
                <div style="flex: 1;">
                    <label>Precio Oferta ($):</label>
                    <input type="number" step="0.01" name="precio_oferta" placeholder="Opcional" style="width: 100%; padding: 0.5rem; border-radius: 4px; border: 1px solid #334155; background: #0f172a; color: #fff; margin-top: 0.3rem;">
                </div>
            </div>

            <div>
                <label>Imagen del Producto:</label>
                <input type="file" name="imagen" accept="image/*" required style="width: 100%; padding: 0.5rem; margin-top: 0.3rem; color: #cbd5e1;">
            </div>

            <button type="submit" style="background: #2563eb; color: #fff; border: none; padding: 0.7rem; border-radius: 4px; font-weight: bold; cursor: pointer; margin-top: 1rem;">Publicar Producto</button>
            <a href="/esc_project/public/" style="text-align: center; color: #94a3b8; text-decoration: none; font-size: 0.9rem;">Volver al Inicio</a>
        </form>
    </main>

</body>
</html>