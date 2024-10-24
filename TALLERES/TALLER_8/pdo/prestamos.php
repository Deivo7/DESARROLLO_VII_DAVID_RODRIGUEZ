<?php
require_once "config.php";

function registrarPrestamo($usuario_id, $libro_id) {
    global $pdo;
    try {
        $pdo->beginTransaction();

        // Registrar el préstamo
        $sql = "INSERT INTO prestamos (usuario_id, libro_id, fecha_prestamo) VALUES (:usuario_id, :libro_id, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':usuario_id' => $usuario_id, ':libro_id' => $libro_id]);

        // Actualizar la cantidad de libros disponibles
        $sql = "UPDATE libros SET cantidad = cantidad - 1 WHERE id = :libro_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':libro_id' => $libro_id]);

        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        registrarError($e->getMessage());
        throw $e;
    }
}

function registrarError($mensaje) {
    $archivo = 'errores.log';
    $fecha = date('Y-m-d H:i:s');
    file_put_contents($archivo, "[$fecha] $mensaje\n", FILE_APPEND);
}
?>