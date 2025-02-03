<?php

class Usuario {
    private $conn;
    private $table = "usuarios";

    public function __construct($db) {
        $this->conn = $db;
    }

    // sacar usuarios
    public function getAll() {
        $consulta = $this->conn->query("SELECT * FROM {$this->table}");
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // sacar usuario ID
    public function getById($id) {
        $consulta = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id_usuario = ?");
        $consulta->execute([$id]);
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // crear usuario
    public function create($data) {
        if (!isset($data['nombre']) || !isset($data['email'])) {
            http_response_code(400);
            return ["error" => "Datos incompletos. Se requiere 'nombre' y 'email'"];
        }
        $telefono = isset($data['telefono']) ? $data['telefono'] : null;
        $consulta = $this->conn->prepare("INSERT INTO {$this->table} (nombre, email, telefono) VALUES (?, ?, ?)");
        if ($consulta->execute([$data['nombre'], $data['email'], $telefono])) {
            http_response_code(201);
            return ["mensaje" => "Usuario creado", "id" => $this->conn->lastInsertId()];
        }
        http_response_code(500);
        return ["error" => "Error al crear usuario"];
    }

    // actualizar usuario
    public function update($id, $data) {
        $fields = [];
        $values = [];
        if (isset($data['nombre'])) {
            $fields[] = "nombre = ?";
            $values[] = $data['nombre'];
        }
        if (isset($data['email'])) {
            $fields[] = "email = ?";
            $values[] = $data['email'];
        }
        if (array_key_exists('telefono', $data)) {
            $fields[] = "telefono = ?";
            $values[] = $data['telefono'];
        }
        if (empty($fields)) {
            http_response_code(400);
            return ["error" => "No hay campos para actualizar"];
        }
        $values[] = $id;
        $consulta = $this->conn->prepare("UPDATE {$this->table} SET " . implode(", ", $fields) . " WHERE id_usuario = ?");
        if ($consulta->execute($values)) {
            return ["mensaje" => "Usuario actualizado"];
        }
        http_response_code(500);
        return ["error" => "Error al actualizar usuario"];
    }

    // eliminar usuario
    public function delete($id) {
        $consulta = $this->conn->prepare("DELETE FROM {$this->table} WHERE id_usuario = ?");
        if ($consulta->execute([$id])) {
            return ["mensaje" => "Usuario eliminado"];
        }
        http_response_code(500);
        return ["error" => "Error al eliminar usuario"];
    }
}
?>
