<?php
require_once "config_pdo.php";

// 1. Mostrar las últimas 5 publicaciones con el nombre del autor y la fecha de publicación
$sql = "SELECT p.titulo, u.nombre as autor, p.fecha_publicacion 
        FROM publicaciones p 
        INNER JOIN usuarios u ON p.usuario_id = u.id 
        ORDER BY p.fecha_publicacion DESC 
        LIMIT 5";

$stmt = $pdo->query($sql);

if ($stmt->rowCount() > 0) {
    echo "<h3>Últimas 5 publicaciones:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Título: " . $row['titulo'] . ", Autor: " . $row['autor'] . ", Fecha: " . $row['fecha_publicacion'] . "<br>";
    }
} else {
    echo "No se encontraron publicaciones.";
}

// 2. Listar los usuarios que no han realizado ninguna publicación
$sql = "SELECT u.nombre 
        FROM usuarios u 
        LEFT JOIN publicaciones p ON u.id = p.usuario_id 
        WHERE p.id IS NULL";

$stmt = $pdo->query($sql);

if ($stmt->rowCount() > 0) {
    echo "<h3>Usuarios sin publicaciones:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Usuario: " . $row['nombre'] . "<br>";
    }
} else {
    echo "Todos los usuarios han realizado publicaciones.";
}

// 3. Calcular el promedio de publicaciones por usuario
$sql = "SELECT AVG(num_publicaciones) as promedio 
        FROM (SELECT COUNT(p.id) as num_publicaciones 
              FROM usuarios u 
              LEFT JOIN publicaciones p ON u.id = p.usuario_id 
              GROUP BY u.id) as subquery";

$stmt = $pdo->query($sql);

if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<h3>Promedio de publicaciones por usuario:</h3>";
    echo "Promedio: " . $row['promedio'];
} else {
    echo "Error al calcular el promedio.";
}

// 4. Encontrar la publicación más reciente de cada usuario
$sql = "SELECT u.nombre, p.titulo, MAX(p.fecha_publicacion) as fecha_publicacion 
        FROM usuarios u 
        INNER JOIN publicaciones p ON u.id = p.usuario_id 
        GROUP BY u.id";

$stmt = $pdo->query($sql);

if ($stmt->rowCount() > 0) {
    echo "<h3>Publicación más reciente de cada usuario:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Usuario: " . $row['nombre'] . ", Título: " . $row['titulo'] . ", Fecha: " . $row['fecha_publicacion'] . "<br>";
    }
} else {
    echo "No se encontraron publicaciones recientes.";
}
?>
