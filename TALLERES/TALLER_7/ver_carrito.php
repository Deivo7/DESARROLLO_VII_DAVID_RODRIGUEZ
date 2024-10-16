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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Carrito de Compras</h1>
    <?php if (empty($_SESSION['carrito'])): ?>
        <p>El carrito está vacío.</p>
    <?php else: ?>
        <ul>
        <?php foreach ($_SESSION['carrito'] as $id => $cantidad): ?>
            <li>
                <?php echo htmlspecialchars($productos[$id]['nombre']); ?> - 
                Cantidad: <?php echo $cantidad; ?> - 
                Precio: $<?php echo number_format($productos[$id]['precio'] * $cantidad, 2); ?>
                <form action="eliminar_del_carrito.php" method="post" style="display:inline;">
                    <input type="hidden" name="producto_id" value="<?php echo $id; ?>">
                    <input type="submit" value="Eliminar">
                </form>
            </li>
            <?php $total += $productos[$id]['precio'] * $cantidad; ?>
        <?php endforeach; ?>
        </ul>
        <p>Total: $<?php echo number_format($total, 2); ?></p>
        <a href="checkout.php">Proceder al Checkout</a>
    <?php endif; ?>
    <br>
    <a href="productos.php">Volver a Productos</a>
</body>
</html>
