<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro vuelos y hoteles</title>
</head>

<style>
    button {
            margin-left: 10px;
            margin-top: 30px;
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
</style>
<body>
    
<h1>Registro de Vuelos y Hoteles</h1>
    <h2>Vuelos</h2>
    <form action="procesar_vuelo.php" method="post">
        Origen: <input type="text" name="origen" required><br>
        Destino: <input type="text" name="destino" required><br>
        Fecha: <input type="date" name="fecha" required><br>
        Plazas disponibles: <input type="number" name="plazas_disponibles" required><br>
        Precio: <input type="number" name="precio" required><br>
        <input type="submit" value="Registrar vuelo">
    </form>

    <h2>Hoteles</h2>
    <form action="procesar_hotel.php" method="post">
        Nombre del hotel: <input type="text" name="nombre_hotel" required><br>
        Ubicación: <input type="text" name="ubicacion" required><br>
        Habitaciones disponibles: <input type="number" name="habitaciones_disponibles" required><br>
        Tarifa por noche: <input type="number" name="tarifa_noche" required><br>
        <input type="submit" value="Registrar hotel">
    </form>

    <button  onclick="window.location.href='ver_reservas.php'">Ver Reservas</button>

</body>
</html>