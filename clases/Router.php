<?php

class Router {
    private $db;
    private $requestMethod;
    private $resource;
    private $id;

    public function __construct($db) {
        $this->db = $db;
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->parseUri();
    }

    private function parseUri() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uriParts = explode('/', $uri);
/*         // Para depurar:
        header('Content-Type: text/plain');
        print_r($uriParts); */
        $this->resource = $uriParts[4] ?? null;
        $this->id = $uriParts[5] ?? null;
    }

    public function run() {
        switch ($this->resource) {
            case 'usuarios':
                require_once __DIR__ . '/Usuario.php';
                $controller = new Usuario($this->db->conn);
                break;
            case 'libros':
                require_once __DIR__ . '/Libro.php';
                $controller = new Libro($this->db->conn);
                break;
            case 'prestamos':
                require_once __DIR__ . '/Prestamo.php';
                $controller = new Prestamo($this->db->conn);
                break;
            default:
                http_response_code(404);
                echo json_encode(["error" => "Recurso no encontrado"]);
                return;
        }
        $this->handleRequest($controller);
    }

    private function handleRequest($controller) {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->id) {
                    echo json_encode($controller->getById($this->id));
                } else {
                    echo json_encode($controller->getAll());
                }
                break;
            case 'POST':
                $data = json_decode(file_get_contents("php://input"), true);
                echo json_encode($controller->create($data));
                break;
            case 'PUT':
                if (!$this->id) {
                    http_response_code(400);
                    echo json_encode(["error" => "ID no proporcionado"]);
                    return;
                }
                $data = json_decode(file_get_contents("php://input"), true);
                echo json_encode($controller->update($this->id, $data));
                break;
            case 'DELETE':
                if (!$this->id) {
                    http_response_code(400);
                    echo json_encode(["error" => "ID no proporcionado"]);
                    return;
                }
                echo json_encode($controller->delete($this->id));
                break;
            default:
                http_response_code(405);
                echo json_encode(["error" => "Método no permitido"]);
                break;
        }
    }
}
?>
