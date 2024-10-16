<?php
require_once 'Estudiante.php';
require_once 'SistemaGestionEstudiantes.php';

// Crear instancia del sistema de gestión
$sistema = new SistemaGestionEstudiantes();

// Agregar algunos estudiantes
$sistema->agregarEstudiante(new Estudiante(1, "Ana", 21, "Ingeniería"));
$sistema->agregarEstudiante(new Estudiante(2, "Carlos", 22, "Medicina"));
$sistema->agregarEstudiante(new Estudiante(3, "Luis", 20, "Derecho"));

// Agregar materias y calificaciones
$sistema->obtenerEstudiante(1)->agregarMateria("Matemáticas", 85);
$sistema->obtenerEstudiante(1)->agregarMateria("Física", 90);
$sistema->obtenerEstudiante(2)->agregarMateria("Biología", 88);
$sistema->obtenerEstudiante(2)->agregarMateria("Química", 92);
$sistema->obtenerEstudiante(3)->agregarMateria("Historia", 75);
$sistema->obtenerEstudiante(3)->agregarMateria("Derecho Constitucional", 80);

// Listar todos los estudiantes
foreach ($sistema->listarEstudiantes() as $estudiante) {
    echo "<br>";
    echo $estudiante;
}

// Calcular y mostrar el promedio general del sistema
echo "<br><br>";
echo "Promedio general de los estudiantes: " . $sistema->calcularPromedioGeneral() . "\n";

// Obtener el mejor estudiante
$mejorEstudiante = $sistema->obtenerMejorEstudiante();

if ($mejorEstudiante) {
    echo "El mejor estudiante es: " . $mejorEstudiante->getNombre() . " con un promedio de " . $mejorEstudiante->obtenerPromedio() . "<br>";
} else {
    echo "No hay estudiantes en el sistema.";
}

?>
