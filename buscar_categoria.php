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


if (empty($id_categoria)) {
    echo "<script>alert('ID de categoría no puede estar vacío'); window.location.href = 'actcategoria.html';</script>";
    exit();
}


$sql = "SELECT * FROM categoria WHERE idcategoria = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id_categoria);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
    $nombre_categoria = $row['nombrecategoria'];
    
    
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Actualizar Categoría</title>
        <link rel='stylesheet' href='stilo.css'>
        <link rel='stylesheet' href='estilomenu.css'>
    </head>
    <body>
        <div class='container'>
            <h1>Actualizar Categoría</h1>
            
            <!-- Formulario para actualizar la categoría -->
            <form action='actualizar_categoria.php' method='POST'>
                <div class='form-group'>
                    <label for='nombre_categoria'>Nombre de la Categoría:</label>
                    <input type='text' id='nombre_categoria' name='nombre_categoria' value='$nombre_categoria' placeholder='Nombre de la Categoría' required>
                </div>
                <div class='form-group'>
                    <input type='hidden' id='id_categoria_hidden' name='id_categoria' value='$id_categoria'>
                    <input type='submit' value='Actualizar Categoría'>
                </div>
            </form>
        </div>
    </body>
    </html>";
} else {
    echo "<script>alert('Categoría no encontrada'); window.location.href = 'actcategoria.html';</script>";
}

$stmt->close();
$conn->close();
?>