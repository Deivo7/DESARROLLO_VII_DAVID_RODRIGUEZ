<?php
require_once "config.php";

function registrarUsuario($nombre, $email, $contrasena) {
    global $pdo;
    $contrasenaHash = password_hash($contrasena, PASSWORD_BCRYPT);
    $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (:nombre, :email, :contrasena)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nombre' => $nombre, ':email' => $email, ':contrasena' => $contrasenaHash]);
}

function listarUsuarios($pagina = 1, $limite = 10) {
    global $pdo;
    $offset = ($pagina - 1) * $limite;
    $sql = "SELECT id, nombre, email FROM usuarios LIMIT :limite OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':limite', $limite, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscarUsuario($criterio) {
    global $pdo;
    $criterio = "%$criterio%";
    $sql = "SELECT id, nombre, email FROM usuarios WHERE nombre LIKE :criterio OR email LIKE :criterio";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':criterio' => $criterio]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function actualizarUsuario($id, $nombre, $email) {
    global $pdo;
    $sql = "UPDATE usuarios SET nombre = :nombre, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nombre' => $nombre, ':email' => $email, ':id' => $id]);
}

function eliminarUsuario($id) {
    global $pdo;
    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
}
?>