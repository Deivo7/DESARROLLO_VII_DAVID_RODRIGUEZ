<?php
// 1. Crear un string JSON con datos de una tienda en línea
$jsonDatos = '
{
    "tienda": "ElectroTech",
    "productos": [
        {"id": 1, "nombre": "Laptop Gamer", "precio": 1200, "categorias": ["electrónica", "computadoras"]},
        {"id": 2, "nombre": "Smartphone 5G", "precio": 800, "categorias": ["electrónica", "celulares"]},
        {"id": 3, "nombre": "Auriculares Bluetooth", "precio": 150, "categorias": ["electrónica", "accesorios"]},
        {"id": 4, "nombre": "Smart TV 4K", "precio": 700, "categorias": ["electrónica", "televisores"]},
        {"id": 5, "nombre": "Tablet", "precio": 300, "categorias": ["electrónica", "computadoras"]}
    ],
    "clientes": [
        {"id": 101, "nombre": "Ana López", "email": "ana@example.com"},
        {"id": 102, "nombre": "Carlos Gómez", "email": "carlos@example.com"},
        {"id": 103, "nombre": "María Rodríguez", "email": "maria@example.com"}
    ]
        }';

// 2. Convertir el JSON a un arreglo asociativo de PHP
$tiendaData = json_decode($jsonDatos, true);

// 3. Función para imprimir los productos
function imprimirProductos($productos) {
    foreach ($productos as $producto) {
        echo "<br><br>";
        echo "{$producto['nombre']} - \${$producto['precio']} - Categorías: " . implode(", ", $producto['categorias']) . "\n";
    }
}


echo "Productos de {$tiendaData['tienda']}:\n";
imprimirProductos($tiendaData['productos']);

// 4. Calcular el valor total del inventario
$valorTotal = array_reduce($tiendaData['productos'], function($total, $producto) {
    return $total + $producto['precio'];
}, 0);

echo "\nValor total del inventario: $$valorTotal\n";
echo "<br><br>";
// 5. Encontrar el producto más caro
$productoMasCaro = array_reduce($tiendaData['productos'], function($max, $producto) {
    return ($producto['precio'] > $max['precio']) ? $producto : $max;
}, $tiendaData['productos'][0]);
echo "<br><br>";
echo "\nProducto más caro: {$productoMasCaro['nombre']} (\${$productoMasCaro['precio']})\n";

// 6. Filtrar productos por categoría
function filtrarPorCategoria($productos, $categoria) {
    return array_filter($productos, function($producto) use ($categoria) {
        return in_array($categoria, $producto['categorias']);
    });
}

$productosDeComputadoras = filtrarPorCategoria($tiendaData['productos'], "computadoras");
echo "\nProductos en la categoría 'computadoras':\n";
imprimirProductos($productosDeComputadoras);

// 7. Agregar un nuevo producto
$nuevoProducto = [
    "id" => 6,
    "nombre" => "Smartwatch",
    "precio" => 250,
    "categorias" => ["electrónica", "accesorios", "wearables"]
];
$tiendaData['productos'][] = $nuevoProducto;

// 8. Convertir el arreglo actualizado de vuelta a JSON
$jsonActualizado = json_encode($tiendaData, JSON_PRETTY_PRINT);
echo "<br><br>";
echo "\nDatos actualizados de la tienda (JSON):\n$jsonActualizado\n";

// TAREA: Implementa una función que genere un resumen de ventas
// Crea un arreglo de ventas (producto_id, cliente_id, cantidad, fecha)
$ventas = [
    ["producto_id" => 1, "cliente_id" => 101, "cantidad" => 1, "fecha" => "2024-09-01"],
    ["producto_id" => 2, "cliente_id" => 102, "cantidad" => 2, "fecha" => "2024-09-02"],
    ["producto_id" => 1, "cliente_id" => 103, "cantidad" => 1, "fecha" => "2024-09-03"],
    ["producto_id" => 3, "cliente_id" => 101, "cantidad" => 3, "fecha" => "2024-09-04"],
    ["producto_id" => 4, "cliente_id" => 102, "cantidad" => 1, "fecha" => "2024-09-05"]
];
// y genera un informe que muestre:
// - Total de ventas
$totalVentas = array_reduce($ventas, function($total, $venta) {
    return $total + $venta['cantidad'];
    }, 0);
// - Producto más vendido
$productosVendidos = [];
        foreach ($ventas as $venta) {
            $productosVendidos[$venta['producto_id']] = ($productosVendidos[$venta['producto_id']] ?? 0) + $venta['cantidad'];
    }
        $productoMasVendidoId = array_keys($productosVendidos, max($productosVendidos))[0];
            $productoMasVendido = array_filter($tiendaData['productos'], function($producto) use ($productoMasVendidoId) {
    return $producto['id'] == $productoMasVendidoId;
});
    $productoMasVendido = reset($productoMasVendido);
// - Cliente que más ha comprado
$clientesCompras = [];
    foreach ($ventas as $venta) {
        $clientesCompras[$venta['cliente_id']] = ($clientesCompras[$venta['cliente_id']] ?? 0) + $venta['cantidad'];
}
    $clienteMasCompradorId = array_keys($clientesCompras, max($clientesCompras))[0];
    $clienteMasComprador = array_filter($tiendaData['clientes'], function($cliente) use ($clienteMasCompradorId) {
        return $cliente['id'] == $clienteMasCompradorId;
});
    $clienteMasComprador = reset($clienteMasComprador);
    echo "<br><br>";
    echo "Total de ventas: $totalVentas productos vendidos\n";
    echo "<br>";
    echo "Producto más vendido: {$productoMasVendido['nombre']} ({$productosVendidos[$productoMasVendidoId]} unidades)\n";
    echo "<br>";
    echo "Cliente que más ha comprado: {$clienteMasComprador['nombre']} ({$clientesCompras[$clienteMasCompradorId]} productos)\n";
?>