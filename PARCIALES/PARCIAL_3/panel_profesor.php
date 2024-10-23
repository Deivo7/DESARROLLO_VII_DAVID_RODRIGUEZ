<?php
session_start();

// Verificacion de que es profesor
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'profesor') {
    header("Location: login.php");
    exit();
}

// Datos precargados de estudiantes y calificaciones
$estudiantes = [
    ['nombre' => 'Juan Pérez', 'id' => '001', 'calificacion' => 85],
    ['nombre' => 'María García', 'id' => '002', 'calificacion' => 92],
    ['nombre' => 'Carlos Rodríguez', 'id' => '003', 'calificacion' => 78],
    ['nombre' => 'Ana Martínez', 'id' => '004', 'calificacion' => 88],
    ['nombre' => 'Luis Sánchez', 'id' => '005', 'calificacion' => 95],
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Profesor</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Bienvenido! <?php echo ($_SESSION['usuario']); ?></h1>
    
    <h2>Lista de Estudiantes y Calificaciones</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Calificación</th>
        </tr>
        <?php foreach ($estudiantes as $estudiante): ?>
        <tr>
            <td><?php echo ($estudiante['id']); ?></td>
            <td><?php echo ($estudiante['nombre']); ?></td>
            <td><?php echo ($estudiante['calificacion']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
