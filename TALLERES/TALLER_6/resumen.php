<?php
if (file_exists('registros.json')) {
    $registros = json_decode(file_get_contents('registros.json'), true);
    
    echo "<h2>Resumen de Registros</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Nombre</th><th>Email</th><th>Edad</th><th>Género</th></tr>";
    
    foreach ($registros as $registro) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($registro['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($registro['email']) . "</td>";
        echo "<td>" . htmlspecialchars($registro['edad']) . "</td>";
        echo "<td>" . htmlspecialchars($registro['genero']) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "<p>No hay registros disponibles.</p>";
}

echo "<br><a href='formulario.html'>Volver al formulario</a>";
?>