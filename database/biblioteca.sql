DROP DATABASE IF EXISTS dbBiblioteca;
CREATE DATABASE dbBiblioteca;

USE dbBiblioteca;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(15)
);

CREATE TABLE libros (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(100) NOT NULL
);

CREATE TABLE prestamos (
    id_prestamo INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_libro INT NOT NULL,
    fecha_prestamo TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_devolucion DATE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_libro) REFERENCES libros(id_libro)
);

-- Insertando usuarios
INSERT INTO usuarios (nombre, email, telefono) VALUES 
('Juan Pérez', 'juan.perez@email.com', '600123456'),
('María López', 'maria.lopez@email.com', '601987654'),
('Carlos Rodríguez', 'carlos.rodriguez@email.com', '602456789'),
('Ana García', 'ana.garcia@email.com', '603789123'),
('Pedro Sánchez', 'pedro.sanchez@email.com', '604321987');

-- Insertando libros
INSERT INTO libros (titulo, autor) VALUES 
('Cien años de soledad', 'Gabriel García Márquez'),
('1984', 'George Orwell'),
('Don Quijote de la Mancha', 'Miguel de Cervantes'),
('Orgullo y prejuicio', 'Jane Austen'),
('El principito', 'Antoine de Saint-Exupéry'),
('Crónica de una muerte anunciada', 'Gabriel García Márquez'),
('Fahrenheit 451', 'Ray Bradbury'),
('El nombre del viento', 'Patrick Rothfuss'),
('Los pilares de la Tierra', 'Ken Follett'),
('La sombra del viento', 'Carlos Ruiz Zafón');

-- Insertando préstamos
INSERT INTO prestamos (id_usuario, id_libro, fecha_prestamo, fecha_devolucion) VALUES 
(1, 2, '2025-01-20 10:00:00', '2025-02-05'),
(2, 4, '2025-01-21 14:30:00', '2025-02-06'),
(3, 1, '2025-01-22 09:15:00', '2025-02-07'),
(4, 5, '2025-01-23 16:45:00', NULL), 
(5, 3, '2025-01-24 11:30:00', '2025-02-09'),
(1, 7, '2025-01-25 13:20:00', NULL), 
(2, 6, '2025-01-26 08:10:00', '2025-02-11'),
(3, 8, '2025-01-27 17:40:00', NULL), 
(4, 9, '2025-01-28 12:25:00', '2025-02-13'),
(5, 10, '2025-01-29 15:55:00', NULL);