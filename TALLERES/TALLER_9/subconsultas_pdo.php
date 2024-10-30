<?php
require_once "config_pdo.php";

try {
    // 1. Productos que tienen un precio mayor al promedio de su categoría
    $sql = "SELECT p.nombre, p.precio, c.nombre as categoria,
            (SELECT AVG(precio) FROM productos WHERE categoria_id = p.categoria_id) as promedio_categoria
            FROM productos p
            JOIN categorias c ON p.categoria_id = c.id
            WHERE p.precio > (
                SELECT AVG(precio)
                FROM productos p2
                WHERE p2.categoria_id = p.categoria_id
            )";

    $stmt = $pdo->query($sql);
    
    echo "<h3>Productos con precio mayor al promedio de su categoría:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Producto: {$row['nombre']}, Precio: ${$row['precio']}, ";
        echo "Categoría: {$row['categoria']}, Promedio categoría: ${$row['promedio_categoria']}<br>";
    }

    // 2. Clientes con compras superiores al promedio
    $sql = "SELECT c.nombre, c.email,
            (SELECT SUM(total) FROM ventas WHERE cliente_id = c.id) as total_compras,
            (SELECT AVG(total) FROM ventas) as promedio_ventas
            FROM clientes c
            WHERE (
                SELECT SUM(total)
                FROM ventas
                WHERE cliente_id = c.id
            ) > (
                SELECT AVG(total)
                FROM ventas
            )";

    $stmt = $pdo->query($sql);
    
    echo "<h3>Clientes con compras superiores al promedio:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Cliente: {$row['nombre']}, Total compras: ${$row['total_compras']}, ";
        echo "Promedio general: ${$row['promedio_ventas']}<br>";
    }

    // Encontrar Productos que nunca se han vendido
    $sql = "SELECT p.nombre, p.precio, c.nombre as categoria
            FROM productos p
            LEFT JOIN detalle_ventas dv ON p.id = dv.producto_id
            JOIN categorias c ON p.categoria_id = c.id
            WHERE dv.id IS NULL";
    
    $stmt = $pdo->query($sql);
    echo "<h3>Productos que nunca se han vendido:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Producto: {$row['nombre']}, Precio: ${$row['precio']}, Categoría: {$row['categoria']}<br>";
    }

    // Listar las categorías con el número de productos y el valor total del inventario
    $sql = "SELECT c.nombre as categoria, 
            COUNT(p.id) as num_productos,
            COALESCE(SUM(p.precio * p.stock), 0) as valor_inventario
            FROM categorias c
            LEFT JOIN productos p ON c.id = p.categoria_id
            GROUP BY c.id, c.nombre";
    
    $stmt = $pdo->query($sql);
    echo "<h3>Inventario por categoría:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Categoría: {$row['categoria']}, Productos: {$row['num_productos']}, ";
        echo "Valor total: ${$row['valor_inventario']}<br>";
    }

    // Encontrar los clientes que han comprado todos los productos de una categoría específica
    $sql = "SELECT c.nombre, c.email
            FROM clientes c
            WHERE NOT EXISTS (
                SELECT p.id
                FROM productos p
                WHERE p.categoria_id = 1
                AND NOT EXISTS (
                    SELECT 1 FROM ventas v
                    JOIN detalle_ventas dv ON v.id = dv.venta_id
                    WHERE v.cliente_id = c.id
                    AND dv.producto_id = p.id
                )
            )";
    
    $stmt = $pdo->query($sql);
    echo "<h3>Clientes que compraron toda la categoría 1:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Cliente: {$row['nombre']}, Email: {$row['email']}<br>";
    }

    // Porcentaje de ventas por producto
    $sql = "SELECT p.nombre,
            SUM(dv.cantidad * dv.precio_unitario) as ventas_producto,
            (SELECT SUM(cantidad * precio_unitario) FROM detalle_ventas) as ventas_totales,
            (SUM(dv.cantidad * dv.precio_unitario) / 
            (SELECT SUM(cantidad * precio_unitario) FROM detalle_ventas) * 100) as porcentaje
            FROM productos p
            LEFT JOIN detalle_ventas dv ON p.id = dv.producto_id
            GROUP BY p.id, p.nombre
            HAVING ventas_producto > 0
            ORDER BY porcentaje DESC";
    
    $stmt = $pdo->query($sql);
    echo "<h3>Porcentaje de ventas por producto:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Producto: {$row['nombre']}, Ventas: ${$row['ventas_producto']}, ";
        echo "Porcentaje: {$row['porcentaje']}%<br>";
    }

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
