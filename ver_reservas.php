<!DOCTYPE html>
<html>
<head>
    <title>Ver Reservas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: darkcyan;
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
</head>
<body>
    <h1>Reservas realizadas</h1>
    <table>
        <thead>
            <tr>
                <th>ID Reserva</th>
                <th>ID Cliente</th>
                <th>Fecha de Reserva</th>
            </tr>
        </thead>
        <tbody>
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

            // Consulta las reservas
            $sql = "SELECT * FROM reserva";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_reserva"] . "</td>";
                    echo "<td>" . $row["id_cliente"] . "</td>";
                    echo "<td>" . $row["fecha_reserva"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No hay reservas registradas.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <h1>Reservas por Hotel</h1>
    <table>
        <thead>
            <tr>
                <th>ID Hotel</th>
                <th>Nombre del Hotel</th>
                <th>Número de Reservas</th>
            </tr>
        </thead>
        <tbody>
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

            // Consulta las reservas por hotel
            $sql = "SELECT id_hotel, nombre, COUNT(id_reserva) AS num_reservas
                    FROM hotel 
                    LEFT JOIN reserva R ON id_hotel = id_hotel
                    GROUP BY id_hotel, nombre
                    HAVING num_reservas > 2";

            $result = $conn->query($sql);

            if ($result !== false && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_hotel"] . "</td>";
                    echo "<td>" . $row["nombre_hotel"] . "</td>";
                    echo "<td>" . $row["num_reservas"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No hay hoteles con más de dos reservas.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
