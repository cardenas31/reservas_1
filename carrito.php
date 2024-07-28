<?php
session_start(); // Iniciar la sesión


// Verificar si existe información en el carrito
if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    $total = 0; // Inicializar el total

    echo '<h2>Carrito de Compras</h2>';

    echo '<table id="paquetes-table" border="1">';
    echo '<tr>';
    echo '<th>N°</th>';
    echo '<th>Paquete Turístico</th>';
    echo '<th>Precio</th>';
    echo '</tr>';

    foreach ($_SESSION['carrito'] as $index => $producto) {
        echo '<tr>';
        echo '<td>' . ($index + 1) . '</td>';
        echo '<td>' . $producto['nombre'] . '</td>';
        echo '<td>$' . $producto['precio'] . '</td>';
        echo '</tr>';

        // Sumar al total
        $total += $producto['precio'];
    }

       //total
    echo '<tr>';
    echo '<td colspan="2"><strong>Total:</strong></td>';
    echo '<td>$' . $total . '</td>';
    echo '</tr>';

    echo '</table>';
} else {
    echo '<p>El carrito está vacío.</p>';
}
?>


<form action="vaciar_carrito.php" method="post" style="padding-top: 20px">
        <input type="hidden" name="vaciar"> 
        <button type="submit btn btn-primary" name="vaciar" >Vaciar Carrito</button>
    </form>

