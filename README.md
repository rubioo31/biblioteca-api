# API de Gestión de Préstamos de Libros

Esta API permite gestionar los recursos de una biblioteca: **usuarios**, **libros** y **prestamos**. Está desarrollada en PHP utilizando PDO para la conexión a MySQL, sin emplear frameworks, y se organiza en clases distribuidas en diferentes archivos para facilitar el mantenimiento y la escalabilidad.

## Estructura del Proyecto

La estructura del proyecto es la siguiente:
```
/biblioteca-api
│   ├── api.php              # Front controller que enruta todas las peticiones
│   ├── index.php            # Interfaz web interactiva para probar la API
│   ├── README.md            # Este archivo
│   ├── config
│   │   └── database.php     # Configuración de la conexión a la base de datos
│   └── clases
│       ├── Database.php     # Clase para la conexión con la base de datos
│       ├── Usuario.php      # CRUD para la tabla "usuarios"
│       ├── Libro.php        # CRUD para la tabla "libros"
│       ├── Prestamo.php     # Operaciones permitidas para la tabla "prestamos"
│       └── Router.php       # Clase que interpreta la URL y redirige a la clase correspondiente
```

## Interfaz de Prueba (index.php)

El archivo `index.php` ofrece una interfaz web para probar todas las funcionalidades de la API.

Accede a: `http://localhost/biblioteca-api/index.php`

> [!CAUTION]
>- No incluyas la carpeta `clases` en la URL.

> [!NOTE]
>- La API valida que existan los registros referenciados (usuarios y libros) antes de crear un préstamo.

> [!IMPORTANT]
>- Asegúrate de que los servidores esten activos y que la ruta base esté correctamente configurada.

## Endpoints Disponibles

### Usuarios

- **GET /usuarios**: Obtener todos los usuarios.  
  **Ejemplo:** `http://localhost/biblioteca-api/api.php/usuarios`

- **GET /usuarios/{id}**: Obtener un usuario específico por su `id_usuario`.  
  **Ejemplo:** `http://localhost/biblioteca-api/api.php/usuarios/1`

- **POST /usuarios**: Crear un nuevo usuario.  
  **Cuerpo (JSON):**
  ```json
  {
      "nombre": "Nombre del Usuario",
      "email": "correo@ejemplo.com",
      "telefono": "600123456"
  }
  ```

- **PUT /usuarios/{id}**: Actualizar un usuario existente.  
  **Ejemplo:** `http://localhost/biblioteca-api/api.php/usuarios/1`  
  **Cuerpo (JSON):**
  ```json
  {
      "email": "nuevoemail@ejemplo.com",
      "telefono": "601987654"
  }
  ```

- **DELETE /usuarios/{id}**: Eliminar un usuario.  
  **Ejemplo:** `http://localhost/biblioteca-api/api.php/usuarios/1`

### Libros

- **GET /libros**: Obtener todos los libros.  
  **Ejemplo:** `http://localhost/biblioteca-api/api.php/libros`

- **GET /libros/{id}**: Obtener un libro específico.  
  **Ejemplo:** `http://localhost/biblioteca-api/api.php/libros/2`

- **POST /libros**: Crear un nuevo libro.  
  **Cuerpo (JSON):**
  ```json
  {
      "titulo": "Título del Libro",
      "autor": "Nombre del Autor"
  }
  ```

- **PUT /libros/{id}**: Actualizar un libro existente.  
  **Cuerpo (JSON):**
  ```json
  {
      "titulo": "Título Actualizado",
      "autor": "Autor Actualizado"
  }
  ```

- **DELETE /libros/{id}**: Eliminar un libro.  
  **Ejemplo:** `http://localhost/biblioteca-api/api.php/libros/2`

### Préstamos

- **POST /prestamos**: Crear un nuevo préstamo.  
  **Cuerpo (JSON):**
  ```json
  {
      "id_usuario": 1,
      "id_libro": 1,
      "fecha_devolucion": "2025-03-01"
  }
  ```

- **GET /prestamos**: Obtener todos los préstamos.  
  **Ejemplo:** `http://localhost/biblioteca-api/api.php/prestamos`

- **GET /prestamos/{id}**: Obtener un préstamo específico.  
  **Ejemplo:** `http://localhost/biblioteca-api/api.php/prestamos/3`

- **PUT /prestamos/{id}**: Actualizar la `fecha_devolucion` de un préstamo.  
  **Cuerpo (JSON):**
  ```json
  {
      "fecha_devolucion": "2025-04-01"
  }
  ```

- **DELETE /prestamos/{id}**: Eliminar un préstamo.  
  **Ejemplo:** `http://localhost/biblioteca-api/api.php/prestamos/3`

