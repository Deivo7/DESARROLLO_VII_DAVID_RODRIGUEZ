<?php
function leerInventario($archivo) {
    $contenido = file_get_contents($archivo);
    return json_decode($contenido, true);
}


function ordenarInventario(&$inventario) {
    usort($inventario, function($a, $b) {
        return strcmp($a['nombre'], $b['nombre']);
    });
}


function mostrarResumenInventario($inventario) {
    ordenarInventario($inventario);
    foreach ($inventario as $producto) {
        echo "Nombre: {$producto['nombre']}, Precio: {$producto['precio']}, Cantidad: {$producto['cantidad']}\n";
        echo "<br>";
    }
}

function calcularValorTotal($inventario) {
    $valorTotal = array_sum(array_map(function($producto) {
        return $producto['precio'] * $producto['cantidad'];
    }, $inventario));
    return $valorTotal;
}

function generarInformeStockBajo($inventario) {
    $stockBajo = array_filter($inventario, function($producto) {
        return $producto['cantidad'] < 5;
    });

    if (empty($stockBajo)) {
        echo "No hay productos con stock bajo.\n";
    } else {
        echo "Productos con stock bajo:\n";
        foreach ($stockBajo as $producto) {
            echo "Nombre: {$producto['nombre']}, Cantidad: {$producto['cantidad']}\n" ;
        }
    }
}


$archivoInventario = 'inventario.json';

// Leer el inventario
$inventario = leerInventario($archivoInventario);

// Mostrar resumen del inventario ordenado
echo "Resumen del Inventario:\n";
echo "<br>";
mostrarResumenInventario($inventario);
echo "\n";

// Calcular y mostrar el valor total del inventario
$valorTotal = calcularValorTotal($inventario);
echo "Valor total del inventario: $valorTotal\n\n";

// Generar y mostrar el informe de productos con stock bajo
generarInformeStockBajo($inventario);

?>