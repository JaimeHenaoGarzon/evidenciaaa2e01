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
$nombre_categoria = $_POST['nombre_categoria'];

if (empty($id_categoria) || empty($nombre_categoria)) {
    echo "<script>alert('Todos los campos son obligatorios'); window.location.href = 'actcategoria.html';</script>";
    exit();
}


$sql = "UPDATE categoria SET nombrecategoria = ? WHERE idcategoria = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nombre_categoria, $id_categoria);

if ($stmt->execute()) {
    echo "<script>alert('Categoría actualizada correctamente'); window.location.href = 'actcategoria.html';</script>";
} else {
    echo "<script>alert('Error al actualizar la categoría'); window.location.href = 'actcategoria.html';</script>";
}

$stmt->close();
$conn->close();
?>