<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdcrud";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$id_categoria = $_POST['id_categoria'];

// Validar que el ID no esté vacío
if (empty($id_categoria)) {
    echo "<script>alert('ID de categoría no puede estar vacío'); window.location.href = 'elicategoria.html';</script>";
    exit();
}


$sql = "DELETE FROM categoria WHERE idcategoria = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id_categoria);

if ($stmt->execute()) {
    echo "<script>alert('Categoría eliminada correctamente'); window.location.href = 'elicategoria.html';</script>";
} else {
    echo "<script>alert('Error al eliminar la categoría'); window.location.href = 'elicategoria.html';</script>";
}

$stmt->close();
$conn->close();
?>