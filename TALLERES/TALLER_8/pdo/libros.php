<?php
require_once "config.php";

function agregarLibro($titulo, $autor, $isbn, $anio, $cantidad) {
    global $pdo;
    $sql = "INSERT INTO libros (titulo, autor, isbn, anio, cantidad) VALUES (:titulo, :autor, :isbn, :anio, :cantidad)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':titulo' => $titulo, ':autor' => $autor, ':isbn' => $isbn, ':anio' => $anio, ':cantidad' => $cantidad]);
}

function listarLibros($pagina = 1, $limite = 10) {
    global $pdo;
    $offset = ($pagina - 1) * $limite;
    $sql = "SELECT * FROM libros LIMIT :limite OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':limite', $limite, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Implementar otras funciones: buscar, actualizar, eliminar
?>