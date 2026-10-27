<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class UsuarioModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Buscar un usuario por su correo electrónico (email)
     */
    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    /**
     * Registrar un nuevo usuario en la base de datos MySQL
     */
    public function registrar($nombre, $email, $password, $rol = 'Comprador y Vendedor') {
        $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)";
        $stmt = $this->db->prepare($sql);
        
        // Encriptar la contraseña usando BCRYPT antes de guardar
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        return $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':password' => $passwordHash,
            ':rol' => $rol
        ]);
    }

    /**
     * Obtener todos los usuarios registrados
     */
    public function obtenerTodos() {
        $sql = "SELECT id, nombre, email, rol, fecha_registro FROM usuarios ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Buscar un usuario por su ID
     */
    public function buscarPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
}