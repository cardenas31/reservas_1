<?php
// conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agencia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$origen = $_POST['origen'];
$destino = $_POST['destino'];
$fecha = $_POST['fecha'];
$plazas = $_POST['plazas_disponibles'];
$precio = $_POST['precio'];

// insertar datos en la tabla VUELO
$sql_vuelo = "INSERT INTO VUELO (origen, destino, fecha, plazas_disponibles, precio)
              VALUES ('$origen', '$destino', '$fecha', $plazas, $precio)";

if ($conn->query($sql_vuelo) === TRUE) {
    echo "Datos de vuelo insertados correctamente";
} else {
    echo "Error al insertar datos de vuelo: " . $conn->error;
}

$conn->close();
?>
