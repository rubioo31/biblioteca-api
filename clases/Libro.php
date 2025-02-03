<?php

class Libro {
    private $conn;
    private $table = "libros";

    public function __construct($db) {
        $this->conn = $db;
    }

    // sacar libros
    public function getAll() {
        $consulta = $this->conn->query("SELECT * FROM {$this->table}");
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // sacar libro id
    public function getById($id) {
        $consulta = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id_libro = ?");
        $consulta->execute([$id]);
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // crear libro
    public function create($data) {
        if (!isset($data['titulo']) || !isset($data['autor'])) {
            http_response_code(400);
            return ["error" => "Datos incompletos. Se requiere 'titulo' y 'autor'"];
        }
        $consulta = $this->conn->prepare("INSERT INTO {$this->table} (titulo, autor) VALUES (?, ?)");
        if ($consulta->execute([$data['titulo'], $data['autor']])) {
            http_response_code(201);
            return ["mensaje" => "Libro creado", "id" => $this->conn->lastInsertId()];
        }
        http_response_code(500);
        return ["error" => "Error al crear libro"];
    }

    // actualizar libro
    public function update($id, $data) {
        $fields = [];
        $values = [];
        if (isset($data['titulo'])) {
            $fields[] = "titulo = ?";
            $values[] = $data['titulo'];
        }
        if (isset($data['autor'])) {
            $fields[] = "autor = ?";
            $values[] = $data['autor'];
        }
        if (empty($fields)) {
            http_response_code(400);
            return ["error" => "No hay campos para actualizar"];
        }
        $values[] = $id;
        $consulta = $this->conn->prepare("UPDATE {$this->table} SET " . implode(", ", $fields) . " WHERE id_libro = ?");
        if ($consulta->execute($values)) {
            return ["mensaje" => "Libro actualizado"];
        }
        http_response_code(500);
        return ["error" => "Error al actualizar libro"];
    }

    // eliminar libro
    public function delete($id) {
        $consulta = $this->conn->prepare("DELETE FROM {$this->table} WHERE id_libro = ?");
        if ($consulta->execute([$id])) {
            return ["mensaje" => "Libro eliminado"];
        }
        http_response_code(500);
        return ["error" => "Error al eliminar libro"];
    }
}
?>
