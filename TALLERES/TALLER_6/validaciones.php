<?php
function validarNombre($nombre) {
    return !empty($nombre) && strlen($nombre) <= 50;
}

function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validarEdad($edad) {
    return is_numeric($edad) && $edad >= 18 && $edad <= 120;
}

function validarSitioWeb($sitioWeb) {
    return empty($sitioWeb) || filter_var($sitioWeb, FILTER_VALIDATE_URL);
}

function validarGenero($genero) {
    $generosValidos = ['masculino', 'femenino', 'otro'];
    return in_array($genero, $generosValidos);
}

function validarIntereses($intereses) {
    $interesesValidos = ['deportes', 'musica', 'lectura'];
    return !empty($intereses) && count(array_intersect($intereses, $interesesValidos)) === count($intereses);
}

function validarComentarios($comentarios) {
    return strlen($comentarios) <= 500;
}

function validarFechaNacimiento($fecha) {
    $fechaActual = new DateTime();
    $fechaNacimiento = DateTime::createFromFormat('Y-m-d', $fecha);
    
    if (!$fechaNacimiento) {
        return false;
    }
    
    $edad = $fechaActual->diff($fechaNacimiento)->y;
    return $edad >= 18 && $edad <= 100;
}

function validarFotoPerfil($archivo) {
    $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
    $tamanoMaximo = 2 * 1024 * 1024; // 2MB
    
    if (!in_array($archivo['type'], $tiposPermitidos)) {
        return false;
    }
    
    if ($archivo['size'] > $tamanoMaximo) {
        return false;
    }
    
    // Verificar si ya existe un archivo con el mismo nombre
    $rutaDestino = 'uploads/' . basename($archivo['name']);
    if (file_exists($rutaDestino)) {
        return false;
    }
    
    return true;
}
?>
