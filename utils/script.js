const apiBase = "http://localhost/alejandro/biblioteca-api/api.php";

        // Funciones Usuarios
        function getUsuarios() {
            fetch(apiBase + "/usuarios")
                .then(response => response.json())
                .then(data => document.getElementById("usuariosResult").textContent = JSON.stringify(data, null, 2))
                .catch(error => console.error("Error:", error));
        }

        function getUsuario(id) {
            fetch(apiBase + "/usuarios/" + id)
                .then(response => response.json())
                .then(data => document.getElementById("usuariosResult").textContent = JSON.stringify(data, null, 2))
                .catch(error => console.error("Error:", error));
        }

        function crearUsuario() {
            const nuevoUsuario = {
                nombre: "Test Usuario",
                email: "test@example.com",
                telefono: "123456789"
            };
            fetch(apiBase + "/usuarios", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(nuevoUsuario)
            })
            .then(response => response.json())
            .then(data => document.getElementById("usuariosResult").textContent = JSON.stringify(data, null, 2))
            .catch(error => console.error("Error:", error));
        }

        function actualizarUsuario(id) {
            const updateData = {
                email: "actualizado@example.com",
                telefono: "987654321"
            };
            fetch(apiBase + "/usuarios/" + id, {
                method: "PUT",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(updateData)
            })
            .then(response => response.json())
            .then(data => document.getElementById("usuariosResult").textContent = JSON.stringify(data, null, 2))
            .catch(error => console.error("Error:", error));
        }

        function eliminarUsuario(id) {
            fetch(apiBase + "/usuarios/" + id, {
                method: "DELETE"
            })
            .then(response => response.json())
            .then(data => document.getElementById("usuariosResult").textContent = JSON.stringify(data, null, 2))
            .catch(error => console.error("Error:", error));
        }

        // Funciones Libros
        function getLibros() {
            fetch(apiBase + "/libros")
                .then(response => response.json())
                .then(data => document.getElementById("librosResult").textContent = JSON.stringify(data, null, 2))
                .catch(error => console.error("Error:", error));
        }

        function getLibro(id) {
            fetch(apiBase + "/libros/" + id)
                .then(response => response.json())
                .then(data => document.getElementById("librosResult").textContent = JSON.stringify(data, null, 2))
                .catch(error => console.error("Error:", error));
        }

        function crearLibro() {
            const nuevoLibro = {
                titulo: "Nuevo Libro",
                autor: "Autor Desconocido"
            };
            fetch(apiBase + "/libros", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(nuevoLibro)
            })
            .then(response => response.json())
            .then(data => document.getElementById("librosResult").textContent = JSON.stringify(data, null, 2))
            .catch(error => console.error("Error:", error));
        }

        function actualizarLibro(id) {
            const updateData = {
                titulo: "Libro Actualizado",
                autor: "Autor Actualizado"
            };
            fetch(apiBase + "/libros/" + id, {
                method: "PUT",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(updateData)
            })
            .then(response => response.json())
            .then(data => document.getElementById("librosResult").textContent = JSON.stringify(data, null, 2))
            .catch(error => console.error("Error:", error));
        }

        function eliminarLibro(id) {
            fetch(apiBase + "/libros/" + id, {
                method: "DELETE"
            })
            .then(response => response.json())
            .then(data => document.getElementById("librosResult").textContent = JSON.stringify(data, null, 2))
            .catch(error => console.error("Error:", error));
        }

        // Funciones Prestamos
        function crearPrestamo() {
            const nuevoPrestamo = {
                id_usuario: 2,
                id_libro: 3,
                fecha_devolucion: "2025-03-01"
            };
            fetch(apiBase + "/prestamos", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(nuevoPrestamo)
            })
            .then(response => response.json())
            .then(data => document.getElementById("prestamosResult").textContent = JSON.stringify(data, null, 2))
            .catch(error => console.error("Error:", error));
        }

        function actualizarPrestamo(id) {
            const updateData = {
                fecha_devolucion: "2025-04-01"
            };
            fetch(apiBase + "/prestamos/" + id, {
                method: "PUT",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(updateData)
            })
            .then(response => response.json())
            .then(data => document.getElementById("prestamosResult").textContent = JSON.stringify(data, null, 2))
            .catch(error => console.error("Error:", error));
        }

        function eliminarPrestamo(id) {
            fetch(apiBase + "/prestamos/" + id, {
                method: "DELETE"
            })
            .then(response => response.json())
            .then(data => document.getElementById("prestamosResult").textContent = JSON.stringify(data, null, 2))
            .catch(error => console.error("Error:", error));
        }