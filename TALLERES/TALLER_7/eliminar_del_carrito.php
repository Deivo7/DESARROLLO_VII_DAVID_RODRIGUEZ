<?php
include 'config_sesion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    $producto_id = filter_input(INPUT_POST, 'producto_id', FILTER_SANITIZE_NUMBER_INT);
    
    if (isset($_SESSION['carrito'][$producto_id])) {
        unset($_SESSION['carrito'][$producto_id]);
    }
    
    header('Location: ver_carrito.php');
    exit;
} else {
    header('Location: ver_carrito.php');
    exit;
}
?>
