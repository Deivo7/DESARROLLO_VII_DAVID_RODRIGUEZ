<?php
require_once "config_mysqli.php";

// Función para procesar una devolución de producto
function procesarDevolucion($conn, $venta_id, $producto_id, $cantidad) {
    $stmt = $conn->prepare("CALL sp_procesar_devolucion(?, ?, ?)");
    $stmt->bind_param("iii", $venta_id, $producto_id, $cantidad);
    
    if ($stmt->execute()) {
        echo "Devolución procesada con éxito.";
    } else {
        echo "Error al procesar la devolución: " . $stmt->error;
    }
    
    $stmt->close();
}

// Función para aplicar descuentos basados en el historial de compras del cliente
function aplicarDescuento($conn, $cliente_id, $descuento) {
    $stmt = $conn->prepare("CALL sp_aplicar_descuento(?, ?)");
    $stmt->bind_param("id", $cliente_id, $descuento);
    
    if ($stmt->execute()) {
        echo "Descuento aplicado con éxito.";
    } else {
        echo "Error al aplicar el descuento: " . $stmt->error;
    }
    
    $stmt->close();
}

// Función para generar un reporte de productos con bajo stock
function reporteBajoStock($conn) {
    $stmt = $conn->prepare("CALL sp_reporte_bajo_stock()");
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h3>Reporte de Productos con Bajo Stock:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Stock</th>
            <th>Cantidad a Reponer</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['nombre']}</td>";
        echo "<td>{$row['stock']}</td>";
        echo "<td>{$row['cantidad_reponer']}</td>";
        echo "</tr>";
    }
    echo "</table>";

    $stmt->close();
}

// Función para calcular comisiones por ventas
function calcularComisiones($conn, $criterio) {
    $stmt = $conn->prepare("CALL sp_calcular_comisiones(?)");
    $stmt->bind_param("s", $criterio);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        echo "<h3>Comisiones por Ventas:</h3>";
        echo "<table border='1'>";
        echo "<tr>
                <th>Cliente ID</th>
                <th>Comisión</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['cliente_id']}</td>";
            echo "<td>{$row['comision']}$</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Error al calcular comisiones: " . $stmt->error;
    }
    
    $stmt->close();
}

// Ejemplo de uso
try {
    procesarDevolucion($conn, 1, 1, 2);
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
aplicarDescuento($conn, 1, 10);
reporteBajoStock($conn);
calcularComisiones($conn, 'monto_total');

mysqli_close($conn);
?>