<?php
$calificacion = 74;
if ($calificacion >= 90) {
    echo "Tu calificación es A.<br>";
} elseif ($calificacion >= 80) {
    echo "Tu calificación es B.<br>";
} elseif ($calificacion >= 70) {
    echo "Tu calificación es C.<br>";
} elseif ($calificacion >= 60) {
    echo "Tu calificación es D.<br>";
} else {
    echo "Tu calificación es F.<br>";
}
echo "<br>";

if ($puntuacion >= 60) {
    $resultado = "Aprobado";
} else {
    $resultado = "Reprobado";
}

switch (true) {
    case ($puntuacion >= 90):
        echo "Excelente trabajo.<br>";
        break;
    case ($puntuacion >= 80):
        echo "Buen trabajo.<br>";
        break;
    case ($puntuacion >= 70):
        echo "Trabajo aceptable.<br>";
        break;
    case ($puntuacion >= 60):
        echo "Necesitas mejorar.<br>";
        break;
    default:
        echo "Debes esforzarte más.<br>";
}
echo "<br>";
?>