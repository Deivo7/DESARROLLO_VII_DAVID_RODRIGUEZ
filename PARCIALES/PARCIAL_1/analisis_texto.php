<?php
include 'utilidades_texto.php';

$frases = [
    "Las Rosas son rojas",
    "PHP es un lenguaje",
    "html es el equeleto de una pagina"
];

echo "<table border='1'>";
echo "<tr><th>Frase</th><th>Contar Palabras</th><th>Contar Vocales</th><th>Invertir Palabras</th></tr>";

foreach ($frases as $frase) {
    echo "<tr>";
    echo "<td>{$frase}</td>";
    echo "<td>" . contar_palabras($frase) . "</td>";
    echo "<td>" . contar_vocales($frase) . "</td>";
    echo "<td>" . invertir_palabras($frase) . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
