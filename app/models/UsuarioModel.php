<?php
namespace App\Models;

use Config\Database;
use PDO;

class UsuarioModel {
    private PDO $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // READ (Todos los usuarios para el CRUD)
    public function obtenerTodos(): array {
        $stmt = $this->db->prepare("SELECT id, nombre, email, telefono, documento_identidad, rol, estado, creado_en FROM usuarios ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // READ (Por ID para editar)
    public function obtenerPorId(int $id) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // READ (Por Email para Auth/Login)
    public function obtenerPorEmail(string $email) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    // READ (Por Documento para validación de Registro)
    public function obtenerPorDocumento(string $documento) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE documento_identidad = :documento LIMIT 1");
        $stmt->execute([':documento' => $documento]);
        return $stmt->fetch();
    }

    // CREATE (Registrar nuevo usuario)
    public function registrar(array $datos): bool {
        $sql = "INSERT INTO usuarios (nombre, email, password, telefono, documento_identidad, rol, estado) 
                VALUES (:nombre, :email, :password, :telefono, :documento, :rol, :estado)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre'    => $datos['nombre'],
            ':email'     => $datos['email'],
            ':password'  => password_hash($datos['password'], PASSWORD_BCRYPT),
            ':telefono'  => $datos['telefono'],
            ':documento' => $datos['documento'],
            ':rol'       => $datos['rol'] ?? 'comprador',
            ':estado'    => $datos['estado'] ?? 'activo'
        ]);
    }

    // UPDATE (Actualizar datos desde el CRUD)
    public function actualizar(int $id, array $datos): bool {
        $sql = "UPDATE usuarios SET nombre = :nombre, email = :email, telefono = :telefono, 
                documento_identidad = :documento, rol = :rol, estado = :estado WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'        => $id,
            ':nombre'    => $datos['nombre'],
            ':email'     => $datos['email'],
            ':telefono'  => $datos['telefono'],
            ':documento' => $datos['documento'],
            ':rol'       => $datos['rol'],
            ':estado'    => $datos['estado'] ?? 'activo'
        ]);
    }

    // DELETE (Eliminar usuario desde el CRUD)
    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}