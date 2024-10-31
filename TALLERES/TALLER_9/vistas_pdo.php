<?php
require_once "config_pdo.php";

// Función para mostrar productos con bajo stock
function mostrarProductosBajoStock($pdo) {
    $sql = "SELECT * FROM vista_productos_bajo_stock";
    $stmt = $pdo->query($sql);

    echo "<h3>Productos con Bajo Stock:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Producto</th>
            <th>Stock</th>
            <th>Total Vendido</th>
            <th>Ingresos Totales</th>
          </tr>";

    if ($stmt->rowCount() == 0) {
        echo "<tr><td colspan='4'>No hay productos con bajo stock.</td></tr>";
    } else {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['producto']}</td>";
            echo "<td>{$row['stock']}</td>";
            echo "<td>{$row['total_vendido']}</td>";
            echo "<td>${$row['ingresos_totales']}</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}

// Función para mostrar historial completo de cada cliente
function mostrarHistorialClientes($pdo) {
    $sql = "SELECT * FROM vista_historial_clientes";
    $stmt = $pdo->query($sql);

    echo "<h3>Historial Completo de Clientes:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Cliente</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
            <th>Fecha de Venta</th>
          </tr>";

    if ($stmt->rowCount() == 0) {
        echo "<tr><td colspan='6'>No hay historial de compras.</td></tr>";
    } else {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['cliente']}</td>";
            echo "<td>{$row['producto']}</td>";
            echo "<td>{$row['cantidad']}</td>";
            echo "<td>{$row['precio_unitario']}$</td>";
            echo "<td>{$row['subtotal']}$</td>";
            echo "<td>{$row['fecha_venta']}</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}

// Función para mostrar métricas de rendimiento por categoría
function mostrarRendimientoPorCategoria($pdo) {
    $sql = "SELECT * FROM vista_rendimiento_por_categoria";
    $stmt = $pdo->query($sql);

    echo "<h3>Métricas de Rendimiento por Categoría:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Categoría</th>
            <th>Total Productos</th>
            <th>Total Vendido</th>
            <th>Ingresos Totales</th>
          </tr>";

    if ($stmt->rowCount() == 0) {
        echo "<tr><td colspan='4'>No hay datos de rendimiento por categoría.</td></tr>";
    } else {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['categoria']}</td>";
            echo "<td>{$row['total_productos']}</td>";
            echo "<td>{$row['total_vendido']}</td>";
            echo "<td>{$row['ingresos_totales']}$</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}

// Función para mostrar tendencias de ventas por mes
function mostrarTendenciasVentas($pdo) {
    $sql = "SELECT * FROM vista_tendencias_ventas";
    $stmt = $pdo->query($sql);

    echo "<h3>Tendencias de Ventas por Mes:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Mes</th>
            <th>Total Ventas</th>
            <th>Ingresos Totales</th>
          </tr>";

    if ($stmt->rowCount() == 0) {
        echo "<tr><td colspan='3'>No hay datos de tendencias de ventas.</td></tr>";
    } else {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['mes']}</td>";
            echo "<td>{$row['total_ventas']}</td>";
            echo "<td>{$row['ingresos_totales']}$</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}

// Mostrar los resultados
mostrarProductosBajoStock($pdo);
mostrarHistorialClientes($pdo);
mostrarRendimientoPorCategoria($pdo);
mostrarTendenciasVentas($pdo);

$pdo = null;
?>