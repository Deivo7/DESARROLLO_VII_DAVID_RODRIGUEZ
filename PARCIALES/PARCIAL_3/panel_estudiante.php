<?php
session_start();

// Verificar que es un estudiante
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'estudiante') {
    header("Location: login.php");
    exit();
}

//  calificaciones
$estudiantes = [
    'estudiante1' => ['nombre' => 'Juan Pérez', 'id' => '001', 'calificacion' => 85],
    'estudiante2' => ['nombre' => 'María García', 'id' => '002', 'calificacion' => 92],
    'estudiante3' => ['nombre' => 'Carlos Rodríguez', 'id' => '003', 'calificacion' => 78],
    'estudiante4' => ['nombre' => 'Ana Martínez', 'id' => '004', 'calificacion' => 88],
    'estudiante5' => ['nombre' => 'Luis Sánchez', 'id' => '005', 'calificacion' => 95],
];

// Obtener los datos del estudiante que ha iniciado sesión
$estudiante_actual = $estudiantes[$_SESSION['usuario']] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Estudiante</title>
    <style>
        .calificacion {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
    <h1>Bienvenido, <?php echo ($estudiante_actual['nombre'] ?? $_SESSION['usuario']); ?></h1>
    
    <?php if ($estudiante_actual): ?>
        <h2>Tu calificación actual es:</h2>
        <p class="calificacion"><?php echo ($estudiante_actual['calificacion']); ?></p>
    <?php else: ?>
        <p>Lo sentimos, no se encontraron datos para tu usuario.</p>
    <?php endif; ?>

    <br>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>

