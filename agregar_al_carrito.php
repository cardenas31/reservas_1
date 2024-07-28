<?php
session_start();

// Agregar al carrito
if (isset($_POST['nombre']) && isset($_POST['precio'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];

    $paquete = ['nombre' => $nombre, 'precio' => $precio];

    if (isset($_SESSION['carrito'])) {
        $_SESSION['carrito'][] = $paquete;
    } else {
        $_SESSION['carrito'] = [$paquete];
    }
}

header('Location: carrito.php'); 
exit;
?>
