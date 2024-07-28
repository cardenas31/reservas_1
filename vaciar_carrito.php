<?php

session_start();
// Vaciar el carrito
if (isset($_POST['vaciar'])) {
    unset($_SESSION['carrito']);
}

header('Location: carrito.php'); 
exit;

?>