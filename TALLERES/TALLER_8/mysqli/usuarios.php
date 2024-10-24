<?php
require_once "config.php";

function registrarUsuario($nombre, $email, $contrasena) {
    global $conn;
    $contrasenaHash = password_hash($contrasena, PASSWORD_BCRYPT);
    $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $email, $contrasenaHash);
    $stmt->execute();
    $stmt->close();
}

function listarUsuarios($pagina = 1, $limite = 10) {
    global $conn;
    $offset = ($pagina - 1) * $limite;
    $sql = "SELECT id, nombre, email FROM usuarios LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $limite, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuarios = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $usuarios;
}

function buscarUsuario($criterio) {
    global $conn;
    $criterio = "%$criterio%";
    $sql = "SELECT id, nombre, email FROM usuarios WHERE nombre LIKE ? OR email LIKE ?";
    $stmt = $conn->prepare($sql