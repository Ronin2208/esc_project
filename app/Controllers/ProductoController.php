<?php

namespace App\Controllers;

use App\Config\Database;
use PDO;

class ProductoController {

    // 1. CREAR PRODUCTO
    public function crear() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $precio = trim($_POST['precio'] ?? '0');
            $nombreImagen = 'laptop.jpg'; // Imagen por defecto

            // Procesar la subida del archivo a la carpeta uploads
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                $nombreImagen = 'prod_' . time() . '_' . rand(100, 999) . '.' . strtolower($ext);
                $dirUploads = $_SERVER['DOCUMENT_ROOT'] . '/esc_project/public/uploads/';

                if (!is_dir($dirUploads)) {
                    mkdir($dirUploads, 0777, true);
                }

                move_uploaded_file($_FILES['imagen']['tmp_name'], $dirUploads . $nombreImagen);
            }

            if (!isset($_SESSION['productos']) || !is_array($_SESSION['productos'])) {
                $_SESSION['productos'] = [];
            }

            $nuevoId = time();

            // Guardar en la Base de Datos esc_db (si la conexión está activa)
            try {
                $db = Database::getConnection();
                $stmt = $db->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (:nombre, :descripcion, :precio, :imagen)");
                $stmt->execute([
                    ':nombre' => $nombre,
                    ':descripcion' => $descripcion,
                    ':precio' => $precio,
                    ':imagen' => $nombreImagen
                ]);
            } catch (\Exception $e) {
                // Silencioso si la tabla no existe aún
            }

            // Guardar en la Sesión PHP activa (al inicio del catálogo)
            array_unshift($_SESSION['productos'], [
                'id' => $nuevoId,
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'imagen' => $nombreImagen
            ]);

            header('Location: /esc_project/public/index.php?url=home');
            exit;
        }

        require_once __DIR__ . '/../Views/producto/crear.php';
    }

    // 2. EDITAR PRODUCTO
    public function editar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id = $_GET['id'] ?? null;
        $productoEditar = null;
        $keyEncontrada = null;

        // Buscar producto en la sesión
        if (isset($_SESSION['productos']) && is_array($_SESSION['productos'])) {
            foreach ($_SESSION['productos'] as $key => $prod) {
                if ((string)($prod['id'] ?? '') === (string)$id) {
                    $productoEditar = $prod;
                    $keyEncontrada = $key;
                    break;
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $precio = trim($_POST['precio'] ?? '0');
            $nombreImagen = $productoEditar['imagen'] ?? 'laptop.jpg';

            // Si sube una nueva imagen, reemplazarla
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                $nombreImagen = 'prod_' . time() . '_' . rand(100, 999) . '.' . strtolower($ext);
                $dirUploads = $_SERVER['DOCUMENT_ROOT'] . '/esc_project/public/uploads/';

                if (!is_dir($dirUploads)) {
                    mkdir($dirUploads, 0777, true);
                }

                move_uploaded_file($_FILES['imagen']['tmp_name'], $dirUploads . $nombreImagen);
            }

            // Actualizar en Sesión
            if ($keyEncontrada !== null) {
                $_SESSION['productos'][$keyEncontrada] = [
                    'id' => $id,
                    'nombre' => $nombre,
                    'descripcion' => $descripcion,
                    'precio' => $precio,
                    'imagen' => $nombreImagen
                ];
            }

            // Actualizar en Base de Datos MySQL
            try {
                $db = Database::getConnection();
                $stmt = $db->prepare("UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, imagen = :imagen WHERE id = :id");
                $stmt->execute([
                    ':nombre' => $nombre,
                    ':descripcion' => $descripcion,
                    ':precio' => $precio,
                    ':imagen' => $nombreImagen,
                    ':id' => $id
                ]);
            } catch (\Exception $e) {
                // Silencioso si la BD no está configurada
            }

            header('Location: /esc_project/public/index.php?url=home');
            exit;
        }

        // Si no existe para editar, volver al catálogo
        if (!$productoEditar) {
            header('Location: /esc_project/public/index.php?url=home');
            exit;
        }

        require_once __DIR__ . '/../Views/producto/editar.php';
    }

    // 3. ELIMINAR PRODUCTO
    public function eliminar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id = $_GET['id'] ?? null;

        if ($id !== null) {
            // Eliminar de la Sesión PHP
            if (isset($_SESSION['productos']) && is_array($_SESSION['productos'])) {
                foreach ($_SESSION['productos'] as $key => $prod) {
                    if ((string)($prod['id'] ?? '') === (string)$id) {
                        unset($_SESSION['productos'][$key]);
                    }
                }
                $_SESSION['productos'] = array_values($_SESSION['productos']); // Reindexar
            }

            // Eliminar de la Base de Datos MySQL
            try {
                $db = Database::getConnection();
                $stmt = $db->prepare("DELETE FROM productos WHERE id = :id");
                $stmt->execute([':id' => $id]);
            } catch (\Exception $e) {
                // Silencioso si falla la BD
            }
        }

        header('Location: /esc_project/public/index.php?url=home');
        exit;
    }
}