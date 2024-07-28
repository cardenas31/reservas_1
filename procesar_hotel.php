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

// obtener datos del formulario
$nombre_hotel = $_POST['nombre_hotel'];
$ubicacion = $_POST['ubicacion'];
$habitaciones = $_POST['habitaciones_disponibles'];
$tarifa = $_POST['tarifa_noche'];

// insertar datos en la tabla HOTEL
$sql_hotel = "INSERT INTO HOTEL (nombre, ubicacion, habitaciones_disponibles, tarifa_noche)
              VALUES ('$nombre_hotel', '$ubicacion', $habitaciones, $tarifa)";

if ($conn->query($sql_hotel) === TRUE) {
    echo "Datos de hotel insertados correctamente";
} else {
    echo "Error al insertar datos de hotel: " . $conn->error;
}

$conn->close();
?>
