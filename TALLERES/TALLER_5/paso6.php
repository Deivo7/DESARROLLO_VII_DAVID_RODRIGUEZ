
<?php
// 1. Crear un arreglo multidimensional de ventas por región y producto
$ventas = [
    "Norte" => [
        "Producto A" => [100, 120, 140, 110, 130],
        "Producto B" => [85, 95, 105, 90, 100],
        "Producto C" => [60, 55, 65, 70, 75]
    ],
    "Sur" => [
        "Producto A" => [80, 90, 100, 85, 95],
        "Producto B" => [120, 110, 115, 125, 130],
        "Producto C" => [70, 75, 80, 65, 60]
    ],
    "Este" => [
        "Producto A" => [110, 115, 120, 105, 125],
        "Producto B" => [95, 100, 90, 105, 110],
        "Producto C" => [50, 60, 55, 65, 70]
    ],
    "Oeste" => [
        "Producto A" => [90, 85, 95, 100, 105],
        "Producto B" => [105, 110, 100, 115, 120],
        "Producto C" => [80, 85, 75, 70, 90]
    ]
];

// 2. Función para calcular el promedio de ventas
function promedioVentas($ventas) {
    return array_sum($ventas) / count($ventas);
}

// 3. Calcular y mostrar el promedio de ventas por región y producto
echo "Promedio de ventas por región y producto:\n";
foreach ($ventas as $region => $productos) {
    echo "<br><br>";
    echo "$region:\n";
    foreach ($productos as $producto => $ventasProducto) {
        $promedio = promedioVentas($ventasProducto);
        echo "  $producto: " . number_format($promedio, 2) . "\n";
    }
    echo "\n";
}

// 4. Función para encontrar el producto más vendido en una región
function productoMasVendido($productos) {
    $maxVentas = 0;
    $productoTop = '';
    foreach ($productos as $producto => $ventas) {
        $totalVentas = array_sum($ventas);
        if ($totalVentas > $maxVentas) {
            $maxVentas = $totalVentas;
            $productoTop = $producto;
        }
    }
    return [$productoTop, $maxVentas];
}

// 5. Encontrar y mostrar el producto más vendido por región
echo "Producto más vendido por región:\n";
foreach ($ventas as $region => $productos) {
    [$productoTop, $ventasTop] = productoMasVendido($productos);
    echo "<br><br>";
    echo "$region: $productoTop (Total: $ventasTop)\n";
}

// 6. Calcular las ventas totales por producto
$ventasTotalesPorProducto = [];
foreach ($ventas as $region => $productos) {
    foreach ($productos as $producto => $ventasProducto) {
        if (!isset($ventasTotalesPorProducto[$producto])) {
            $ventasTotalesPorProducto[$producto] = 0;
        }
        $ventasTotalesPorProducto[$producto] += array_sum($ventasProducto);
    }
}

echo "\nVentas totales por producto:\n";
arsort($ventasTotalesPorProducto);
foreach ($ventasTotalesPorProducto as $producto => $total) {
    echo "<br><br>";
    echo "$producto: $total\n";
}

// 7. Encontrar la región con mayores ventas totales
$ventasTotalesPorRegion = array_map(function($productos) {
    return array_sum(array_map('array_sum', $productos));
}, $ventas);

$regionTopVentas = array_keys($ventasTotalesPorRegion, max($ventasTotalesPorRegion))[0];
echo "<br><br>";
echo "\nRegión con mayores ventas totales: $regionTopVentas\n";

// 8. Implementar función para calcular el crecimiento de ventas

function calcularCrecimiento($ventasInicial, $ventasFinal) {
    if ($ventasInicial == 0) {
        return 0; // Evitar divisiones por cero
    }
    return (($ventasFinal - $ventasInicial) / $ventasInicial) * 100;
}

// 9. Calcular el crecimiento de ventas por región y producto
$crecimientoPorRegion = [];
$mayorCrecimiento = ['region' => '', 'producto' => '', 'crecimiento' => 0];

echo "<br><br>Crecimiento de ventas (primer mes vs último mes):\n";
foreach ($ventas as $region => $productos) {
    echo "<br>$region:\n";
    foreach ($productos as $producto => $ventasProducto) {
        $crecimiento = calcularCrecimiento($ventasProducto[0], $ventasProducto[count($ventasProducto) - 1]);
        echo "  $producto: " . number_format($crecimiento, 2) . "%\n";

        // Guardar el crecimiento en un arreglo para futuras comparaciones
        $crecimientoPorRegion[$region][$producto] = $crecimiento;

        // Comparar para encontrar el mayor crecimiento
        if ($crecimiento > $mayorCrecimiento['crecimiento']) {
            $mayorCrecimiento = ['region' => $region, 'producto' => $producto, 'crecimiento' => $crecimiento];
        }
    }
}

// 10. Mostrar el producto y la región con el mayor crecimiento
echo "<br><br>Mayor crecimiento de ventas:\n";
echo "Región: {$mayorCrecimiento['region']}, Producto: {$mayorCrecimiento['producto']}, Crecimiento: " . number_format($mayorCrecimiento['crecimiento'], 2) . "%\n";


?>