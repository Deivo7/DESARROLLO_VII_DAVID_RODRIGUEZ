<?php
require_once "config.php";

function agregarLibro($titulo, $autor, $isbn, $anio, $cantidad) {
    global $conn;
    $sql = "INSERT INTO libros (titulo, autor, isbn, anio, cantidad) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $titulo, $autor, $isbn, $anio, $cantidad);
    $stmt->execute();
    $stmt->close();
}

function listarLibros($pagina = 1, $limite = 10) {
    global $conn;
    $offset = ($pagina - 1) * $limite;
    $sql = "SELECT * FROM libros LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $limite, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    $libros = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $libros;
}

// Implementar otras funciones: buscar, actualizar, eliminar
?>