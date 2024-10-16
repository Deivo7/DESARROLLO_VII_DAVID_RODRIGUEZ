<?php
// Configurar opciones de sesión
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);

session_start();

// Regenerar el ID de sesión periódicamente
if (!isset($_SESSION['ultima_actividad']) || (time() - $_SESSION['ultima_actividad'] > 300)) {
    session_regenerate_id(true);
    $_SESSION['ultima_actividad'] = time();
}

// Inicializar el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
?>
