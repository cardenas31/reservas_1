

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Vuelos</title>
</head>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            text-align: center;
            margin: 20px auto;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        ul {
            list-style: none;
            padding: 10px;
            margin: 20px auto;
            width: 80%;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        li {
            margin-top: 10px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        li:last-child {
            border-bottom: none;
        }
        button {
            margin-left: 20px;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f5f5f5;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
    </style>
<body>
    <h1>Busca tu Destino</h1>

    <form action="" method="GET">
        <input type="text" name="vuelo" placeholder="Ingrese un vuelo">
        <input type="submit" value="Buscar">
    </form>

    <?php

     //función para buscar vuelos
    if(isset($_GET["vuelo"]) && $_GET["vuelo"] != ''){
        // conexión a la base de datos 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agencia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$vuelo = $_GET['vuelo'];


$sql = "SELECT * FROM vuelo WHERE origen LIKE '%$vuelo%'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    echo "<ul>";
    while($row = $result->fetch_assoc()){
        echo "<li>" . "Vuelo desde " . $row["origen"] . " Hacia ". $row["destino"]. " Fecha " . $row["fecha"] . 
        ' <form action="resultados_busqueda.php" method="post">
            <input type="hidden" name="id_vuelo" value="' . $row["id_vuelo"] . '">
            <button type="submit" name="reservar">Reservar</button>
        </form>' .
        "</li>";
    }
    
    echo  "</ul> " ;
}
else{
    echo "<p  style='color: blue; font-weight: bold; text-align: center;'> "."Vuelo hacia $vuelo no disponible " ."</p>";
 }

}

?>

<!--Buscar por hotel-->

    <form action="" method="GET">
        <input type="text" name="hotel" placeholder="Ingrese un hotel">
        <input type="submit" value="Buscar">
        
    </form>

    <?php
    // Conexión a la base de datos (ajusta los detalles según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "agencia";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    if (isset($_GET["hotel"]) && $_GET["hotel"] != '') {
        $hotel = $_GET["hotel"];

        $sql = "SELECT nombre, ubicacion, tarifa_noche FROM hotel WHERE nombre LIKE '%$hotel%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Nombre</th><th>Ubicación</th><th>Tarifa por Noche</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["ubicacion"] . "</td>";
                echo "<td>$" . $row["tarifa_noche"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontraron hoteles con ese nombre.</p>";
        }
    }

    
    $conn->close();
    ?>

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

//obtener el ID del vuelo seleccionado (debe provenir del formulario)
if (isset($_POST["id_vuelo"])) {
    $id_vuelo = $_POST["id_vuelo"];

    
    // insertar la reserva en la tabla "reserva"
    $sql = "INSERT INTO reserva (id_cliente, fecha_reserva, id_vuelo, id_hotel) VALUES (?, NOW(), ?, ?)";
    $stmt = $conn->prepare($sql);
    $id_cliente = 1; 
    $id_hotel = 1; 

    $stmt->bind_param("iii", $id_cliente, $id_vuelo, $id_hotel);

    if ($stmt->execute()) {
        echo "<p style='color: green; font-weight: bold; text-align: center;'>¡Reserva realizada con éxito!</p>";
    } else {
        echo "<p style='color: red; font-weight: bold;'>Error al registrar la reserva: " . $stmt->error . "</p>";
    }
    
    $stmt->close();
}

$conn->close();
?>


<button  onclick="window.location.href='ver_reservas.php'">Ver Reservas</button>



    
</body>
</html>
