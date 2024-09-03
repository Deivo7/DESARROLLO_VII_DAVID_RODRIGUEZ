<?php
function calcular_descuento($total_compra) {
    if ($total_compra > 1000) {
        return $total_compra * 0.15;
    } else if ($total_compra > 500) {
        return $total_compra * 0.10;
    } else if ($total_compra >= 100) {
        return $total_compra * 0.05;
    } else {
        return 0;
    }
}

function aplicar_impuesto($subtotal) {
    return $subtotal * 0.07;
}

?>