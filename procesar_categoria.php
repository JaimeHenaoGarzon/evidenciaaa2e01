<?php
// Datos de conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'bdcrud';

// Crear la conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$id_categoria = $_POST['id_categoria'];
$nombre_categoria = $_POST['nombre_categoria'];

// Preparar y ejecutar la consulta
$sql = "INSERT INTO categoria (idcategoria, nombrecategoria) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id_categoria, $nombre_categoria);

if ($stmt->execute()) {
    echo "Categoría registrada exitosamente";
    header("Location: aggcategoria.html"); // Cambia esto a la página que desees
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>