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


$sql = "SELECT * FROM categoria WHERE idcategoria = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id_categoria);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Eliminar Categoría</title>
        <link rel='stylesheet' href='stilo.css'>
        <link rel='stylesheet' href='estilomenu.css'>
    </head>
    <body>
        <div class='container'>
            <h1>Eliminar Categoría</h1>
            
            <!-- Formulario para eliminar la categoría -->
            <form action='eliminar_categoria.php' method='POST'>
                <div class='form-group'>
                    <p>¿Estás seguro de que deseas eliminar esta categoría?</p>
                    <input type='hidden' id='id_categoria_hidden' name='id_categoria' value='$id_categoria'>
                    <input type='submit' value='Eliminar Categoría'>
                </div>
            </form>
        </div>
    </body>
    </html>";
} else {
    echo "<script>alert('Categoría no encontrada'); window.location.href = 'elicategoria.html';</script>";
}

$stmt->close();
$conn->close();
?>