<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agencia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del vuelo seleccionado (debe provenir del formulario)
if (isset($_POST["id_vuelo"])) {
    $id_vuelo = $_POST["id_vuelo"];

    
    // Insertar la reserva en la tabla "reserva"
    $sql = "INSERT INTO reserva (id_cliente, fecha_reserva, id_vuelo, id_hotel) VALUES (?, NOW(), ?, ?)";
    $stmt = $conn->prepare($sql);
    $id_cliente = 1; // ID del cliente (ajusta según tu lógica)
    $id_hotel = 1; // ID del hotel (ajusta según tu lógica)

    $stmt->bind_param("iii", $id_cliente, $id_vuelo, $id_hotel);

    if ($stmt->execute()) {
        echo "Reserva realizada con éxito.";
    } else {
        echo "Error al registrar la reserva: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "ID de vuelo no proporcionado.";
}

$conn->close();
?>
