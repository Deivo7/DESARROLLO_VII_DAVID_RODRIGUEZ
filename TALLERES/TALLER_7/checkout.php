<?php
include 'config_sesion.php';

$productos = [
    1 => ['nombre' => 'Producto 1', 'precio' => 10.99],
    2 => ['nombre' => 'Producto 2', 'precio' => 15.99],
    3 => ['nombre' => 'Producto 3', 'precio' => 20.99],
    4 => ['nombre' => 'Producto 4', 'precio' => 25.99],
    5 => ['nombre' => 'Producto 5', 'precio' => 30.99],
];

$total = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    
    // Crear cookie segura con el nombre del usuario
    setcookie("usuario", $nombre, [
        'expires' => time() + 86400,
        'path' => '/',
        'domain' => '',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    
    // Procesar la compra y vaciar el carrito
    $resumen = $_SESSION['carrito'];
    $_SESSION['carrito'] = [];
    
    // Mostrar resumen de la compra
    echo "<h1>Gracias por tu compra, " . htmlspecialchars($nombre) . "!</h1>";
    echo "<h2>Resumen de la compra:</h2>";
    echo "<ul>";
    foreach ($resumen as $id => $cantidad) {
        echo "<li>" . htmlspecialchars($productos[$id]['nombre']) . " - Cantidad: " . $cantidad . "</li>";
        $total += $productos[$id]['precio'] * $cantidad;
    }
    echo "</ul>";
    echo "<p>Total: $" . number_format($total, 2) . "</p>";
    echo "<a href='productos.php'>Volver a la tienda</a>";
} else {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>
    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <input type="submit" value="Finalizar Compra">
    </form>
</body>
</html>
<?php
}
?>
