<?php
require_once '../config/config.php';

class AuthController {
    public function login() {
        // ... Código para iniciar sesión con Google OAuth ...
        // Redirigir a Google para autenticación
        $authUrl = "https://accounts.google.com/o/oauth2/auth?client_id=" . CLIENT_ID . "&redirect_uri=" . REDIRECT_URI . "&response_type=code&scope=email profile";
        header('Location: ' . $authUrl);
        exit();
    }

    public function callback() {
        // ... Código para manejar la respuesta de Google ...
        // Obtener el token y los datos del usuario
    }
}
?>
