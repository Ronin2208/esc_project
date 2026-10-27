<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class ProductoModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Obtener todos los productos grabados en MySQL
    public function obtenerTodos() {
        $sql = "SELECT * FROM productos ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Registrar un nuevo producto en MySQL
    public function guardar($nombre, $descripcion, $precio, $imagen) {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (:nombre, :descripcion, :precio, :imagen)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':precio' => $precio,
            ':imagen' => $imagen
        ]);
    }
}