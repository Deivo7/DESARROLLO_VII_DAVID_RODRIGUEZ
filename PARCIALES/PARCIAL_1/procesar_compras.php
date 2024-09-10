<?php
include 'funciones_tienda.php';

$productos = [
    'sueter' => 50,
    'jeans' => 70,
    'abrigo' => 80,
    'franela' => 10,
    'sombrero' => 25
];

$carrito = [
    'sueter' => 7,
    'jeans' => 4,
    'abrigo' => 5,
    'franela' => 15,
    'sombrero' => 10
];

$subtotal = 0;
foreach ($carrito as $producto => $cantidad) {
    $subtotal += $productos[$producto] * $cantidad;
}

$descuento = calcular_descuento($subtotal);
$impuesto = aplicar_impuesto($subtotal);
$total_a_pagar = calcular_total($subtotal, $descuento, $impuesto);

echo "<h2>Resumen de la Compra</h2>";
echo "<table border='1'>";
echo "<tr><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Precio Total</th></tr>";

foreach ($carrito as $producto => $cantidad) {
    if ($cantidad > 0) {
        $precio_total = $productos[$producto] * $cantidad;
        echo "<tr>";
        echo "<td>{$producto}</td>";
        echo "<td>{$cantidad}</td>";
        echo "<td>\${$productos[$producto]}</td>";
        echo "<td>\${$precio_total}</td>";
        echo "</tr>";
    }
}

echo "</table>";
echo "<p><strong>Subtotal:</strong> \${$subtotal}</p>";
echo "<p><strong>Descuento Aplicado:</strong> \${$descuento}</p>";
echo "<p><strong>Impuesto:</strong> \${$impuesto}</p>";
echo "<p><strong>Total a Pagar:</strong> \${$total_a_pagar}</p>";

?>