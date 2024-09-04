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
    'camisa' => 2,
    'pantalon' => 1,
    'zapatos' => 1,
    'calcetines' => 3,
    'gorra' => 0
];

$subtotal = 0;
foreach ($carrito as $producto => $cantidad) {
    $subtotal += $productos[$producto] * $cantidad;
}

$descuento = calcular_descuento($subtotal);
$impuesto = aplicar_impuesto($subtotal);


?>