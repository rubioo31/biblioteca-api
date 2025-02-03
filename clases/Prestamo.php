<?php

class Prestamo {
    private $conn;
    private $table = "prestamos";

    public function __construct($db) {
        $this->conn = $db;
    }

    // crear prestamo
    public function create($data) {
        if (!isset($data['id_usuario']) || !isset($data['id_libro'])) {
            http_response_code(400);
            return ["error" => "Datos incompletos. Se requiere 'id_usuario' e 'id_libro'"];
        }
        $fechaPrestamo = isset($data['fecha_prestamo']) ? $data['fecha_prestamo'] : null;
        $fechaDevolucion = isset($data['fecha_devolucion']) ? $data['fecha_devolucion'] : null;

        if ($fechaPrestamo) {
            $consulta = $this->conn->prepare("INSERT INTO {$this->table} (id_usuario, id_libro, fecha_prestamo, fecha_devolucion) VALUES (?, ?, ?, ?)");
            $params = [$data['id_usuario'], $data['id_libro'], $fechaPrestamo, $fechaDevolucion];
        } else {
            $consulta = $this->conn->prepare("INSERT INTO {$this->table} (id_usuario, id_libro, fecha_devolucion) VALUES (?, ?, ?)");
            $params = [$data['id_usuario'], $data['id_libro'], $fechaDevolucion];
        }

        if ($consulta->execute($params)) {
            http_response_code(201);
            return ["mensaje" => "prestamo creado", "id" => $this->conn->lastInsertId()];
        }
        http_response_code(500);
        return ["error" => "Error al crear prestamo"];
    }

    // actualizar fecha_devolucion de prestamo
    public function update($id, $data) {
        if (!isset($data['fecha_devolucion'])) {
            http_response_code(400);
            return ["error" => "Debe proporcionar 'fecha_devolucion' para actualizar"];
        }
        $consulta = $this->conn->prepare("UPDATE {$this->table} SET fecha_devolucion = ? WHERE id_prestamo = ?");
        if ($consulta->execute([$data['fecha_devolucion'], $id])) {
            return ["mensaje" => "prestamo actualizado"];
        }
        http_response_code(500);
        return ["error" => "Error al actualizar prestamo"];
    }

    // eliminar prestamo
    public function delete($id) {
        $consulta = $this->conn->prepare("DELETE FROM {$this->table} WHERE id_prestamo = ?");
        if ($consulta->execute([$id])) {
            return ["mensaje" => "prestamo eliminado"];
        }
        http_response_code(500);
        return ["error" => "Error al eliminar prestamo"];
    }
}
?>
