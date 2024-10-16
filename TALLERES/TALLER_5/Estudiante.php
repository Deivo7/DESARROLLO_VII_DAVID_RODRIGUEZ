<?php

class Estudiante {
    private $id;
    private $nombre;
    private $edad;
    private $carrera;
    private $materias;

    // Constructor
    public function __construct($id, $nombre, $edad, $carrera) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->carrera = $carrera;
        $this->materias = [];
    }

    // Getter para obtener el nombre
    public function getNombre() {
        return $this->nombre;
    }

    // Getter para obtener el promedio
    public function obtenerPromedio() {
        if (count($this->materias) === 0) {
            return 0;
        }
        $total = array_sum($this->materias);
        return $total / count($this->materias);
    }

    // Otros getters para obtener otras propiedades
    public function getCarrera() {
        return $this->carrera;
    }

    public function getId() {
        return $this->id;
    }

    // Método para agregar una materia
    public function agregarMateria($materia, $calificacion) {
        $this->materias[$materia] = $calificacion;
    }
}

?>
