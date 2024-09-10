<?php
function contar_palabras($texto) {
    return str_word_count($texto);
}

function contar_vocales($texto) {
    $vocales = ['a', 'e', 'i', 'o', 'u'];
    $texto = strtolower($texto);
    $contador = 0;

    foreach (str_split($texto) as $letra) {
        if (in_array($letra, $vocales)) {
            $contador++;
        }
    }

    return $contador;
}

function invertir_palabras($texto) {
    $palabras = explode(" ", $texto);
    $palabras_invertidas = array_reverse($palabras);
    return implode(" ", $palabras_invertidas);
}
?>
