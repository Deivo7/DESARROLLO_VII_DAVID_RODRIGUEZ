<?php
include 'config_sesion.php';

$productos = [
    1 => ['nombre' => 'Producto 1', 'precio' => 10.99],
    2 => ['nombre' => 'Producto 2', 'precio' => 15.99],
    3 => ['nombre' => 'Producto 3', 'precio' => 20.99],
    4 => ['nombre' => 'Producto 4', 'precio' => 25.99],
    5 => ['nombre' => 'Producto 5', 'precio' => 30.99],
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
</head>
<body>
    <h1>Lista de Productos</h1>
    <ul>
    <?php foreach ($productos as $id => $producto): ?>
        <li>
            <?php echo htmlspecialchars($producto['nombre']); ?> - 
            $<?php echo number_format($producto['precio'], 2); ?>
            <form action="agregar_al_carrito.php" method="post">
                <input type="hidden" name="producto_id" value="<?php echo $id; ?>">
                <input type="submit" value="Añadir al carrito">
            </form>
        </li>
    <?php endforeach; ?>
    </ul>
    <a href="ver_carrito.php">Ver Carrito</a>
</body>
</html>
