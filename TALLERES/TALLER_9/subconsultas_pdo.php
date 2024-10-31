<?php
require_once "config_pdo.php";

try {
    // 1. Productos que nunca se han vendido
    $sql = "SELECT p.nombre, p.precio
            FROM productos p
            LEFT JOIN detalles_venta dv ON p.id = dv.producto_id
            WHERE dv.producto_id IS NULL";

    $stmt = $pdo->query($sql);
    
    echo "<h3>Productos que nunca se han vendido:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Producto: {$row['nombre']}, Precio: $" . number_format($row['precio'], 2) . "<br>";
    }

    // 2. Listar las categorías con el número de productos y el valor total del inventario
    $sql = "SELECT c.nombre as categoria, 
                   COUNT(p.id) as num_productos, 
                   SUM(p.precio * p.stock) as valor_inventario
            FROM categorias c
            LEFT JOIN productos p ON c.id = p.categoria_id
            GROUP BY c.id";

    $stmt = $pdo->query($sql);
    
    echo "<h3>Categorías con número de productos y valor total del inventario:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Categoría: {$row['categoria']}, Número de productos: {$row['num_productos']}, Valor total: $" . number_format($row['valor_inventario'] ?? 0, 2) . "<br>";
    }

    // 3. Encontrar los clientes que han comprado todos los productos de una categoría específica (por ejemplo, 'Electrónica')
    $categoria_especifica = 'Electrónica';
    $sql = "SELECT c.nombre
            FROM clientes c
            WHERE NOT EXISTS (
                SELECT p.id
                FROM productos p
                WHERE p.categoria_id = (SELECT id FROM categorias WHERE nombre = :categoria)
                AND NOT EXISTS (
                    SELECT dv.id
                    FROM detalles_venta dv
                    WHERE dv.producto_id = p.id AND dv.venta_id IN (
                        SELECT v.id FROM ventas v WHERE v.cliente_id = c.id
                    )
                )
            )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['categoria' => $categoria_especifica]);
    
    echo "<h3>Clientes que han comprado todos los productos de la categoría '$categoria_especifica':</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Cliente: {$row['nombre']}<br>";
    }

    // 4. Calcular el porcentaje de ventas de cada producto respecto al total de ventas
    $sql = "SELECT p.nombre, 
                   SUM(dv.cantidad * dv.precio_unitario) as total_ventas,
                   (SELECT SUM(total) FROM ventas) as total_general,
                   (SUM(dv.cantidad * dv.precio_unitario) / (SELECT SUM(total) FROM ventas)) * 100 as porcentaje_ventas
            FROM productos p
            LEFT JOIN detalles_venta dv ON p.id = dv.producto_id
            GROUP BY p.id";

    $stmt = $pdo->query($sql);
    
    echo "<h3>Porcentaje de ventas de cada producto:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Producto: {$row['nombre']}, Total ventas: $" . number_format($row['total_ventas'] ?? 0, 2) . ", Porcentaje de ventas: " . number_format($row['porcentaje_ventas'] ?? 0, 2) . "%<br>";
    }

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>