<?php

class SistemaGestionEstudiantes {
    private $estudiantes; // Arreglo de objetos Estudiante
    private $graduados; // Arreglo de estudiantes graduados

    // Constructor
    public function __construct() {
        $this->estudiantes = [];
        $this->graduados = [];
    }

    // Método para agregar un nuevo estudiante
    public function agregarEstudiante(Estudiante $estudiante) {
        $this->estudiantes[$estudiante->obtenerDetalles()['id']] = $estudiante;
    }

    // Método para obtener un estudiante por su ID
    public function obtenerEstudiante(int $id): ?Estudiante {
        return $this->estudiantes[$id] ?? null;
    }

    // Listar todos los estudiantes
    public function listarEstudiantes(): array {
        return $this->estudiantes;
    }

    // Calcular el promedio general de todos los estudiantes
    public function calcularPromedioGeneral(): float {
        if (count($this->estudiantes) === 0) {
            return 0;
        }
        $promedios = array_map(function($estudiante) {
            return $estudiante->obtenerPromedio();
        }, $this->estudiantes);
        return array_sum($promedios) / count($promedios);
    }

    // Obtener estudiantes por carrera
    public function obtenerEstudiantesPorCarrera(string $carrera): array {
        return array_filter($this->estudiantes, function($estudiante) use ($carrera) {
            return $estudiante->obtenerDetalles()['carrera'] === $carrera;
        });
    }

    // Obtener el mejor estudiante (con el promedio más alto)
    public function obtenerMejorEstudiante() {
        if (empty($this->estudiantes)) {
            return null; // Si no hay estudiantes, retorna null o maneja como prefieras.
        }
    
        return array_reduce($this->estudiantes, function($mejor, $actual) {
            // Si $mejor es null, asignamos $actual como el primer valor para comparar
            if ($mejor === null) {
                return $actual;
            }
    
            // Si $actual es null (aunque no debería), saltamos al siguiente
            if ($actual === null) {
                return $mejor;
            }
    
            return $actual->obtenerPromedio() > $mejor->obtenerPromedio() ? $actual : $mejor;
        }, null); // Inicializamos $mejor con null
    }

    // Generar un reporte de rendimiento por materia
    public function generarReporteRendimiento(): array {
        $reporte = [];
        foreach ($this->estudiantes as $estudiante) {
            foreach ($estudiante->obtenerDetalles()['materias'] as $materia => $calificacion) {
                if (!isset($reporte[$materia])) {
                    $reporte[$materia] = ['promedio' => 0, 'max' => 0, 'min' => 100, 'total' => 0];
                }
                $reporte[$materia]['total']++;
                $reporte[$materia]['promedio'] += $calificacion;
                $reporte[$materia]['max'] = max($reporte[$materia]['max'], $calificacion);
                $reporte[$materia]['min'] = min($reporte[$materia]['min'], $calificacion);
            }
        }

        foreach ($reporte as $materia => &$datos) {
            $datos['promedio'] = $datos['promedio'] / $datos['total'];
        }

        return $reporte;
    }

    // Graduar a un estudiante
    public function graduarEstudiante(int $id): bool {
        if (isset($this->estudiantes[$id])) {
            $this->graduados[$id] = $this->estudiantes[$id];
            unset($this->estudiantes[$id]);
            return true;
        }
        return false;
    }

    // Generar ranking de estudiantes
    public function generarRanking(): array {
        usort($this->estudiantes, function($a, $b) {
            return $b->obtenerPromedio() <=> $a->obtenerPromedio();
        });
        return $this->estudiantes;
    }
}

?>
