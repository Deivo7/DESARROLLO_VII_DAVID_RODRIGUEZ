<?php
// Archivo: clases.php

class Tarea implements Detalle{
    public $id;
    public $titulo;
    public $descripcion;
    public $estado;
    public $prioridad;
    public $fechaCreacion;
    public $tipo;

    public function __construct($datos) {
        foreach ($datos as $key => $value) {
            $this->$key = $value;
        }
    }

    public function obtenerDetallesEspecificos(): string {
        return ''; // Se sobrescribirá en las clases hijas
    }

    // Implementar estos getters
    // public function getEstado() { }
    // public function getPrioridad() { }
}

class GestorTareas {
    private $tareas = [];

    public function cargarTareas() {
        $json = file_get_contents('tareas.json');
        $data = json_decode($json, true);
        foreach ($data as $tareaData) {
            $tarea = new Tarea($tareaData);
            $this->tareas[] = $tarea;
        }
        
        return $this->tareas;
    }
}


// Clase TareaDesarrollo
class TareaDesarrollo extends Tarea {
    public $lenguajeProgramacion;

    public function __construct($datos) {
        parent::__construct($datos);
        $this->lenguajeProgramacion = $datos['lenguajeProgramacion'] ?? '';
    }

    public function obtenerDetallesEspecificos(): string {
        return "Lenguaje de Programación: $this->lenguajeProgramacion";
    }
}


// Interfaz: Detalle.php
interface Detalle {
    public function obtenerDetallesEspecificos(): string;
}







// Implementar:
// 1. La interfaz Detalle
// 2. Modificar la clase Tarea para implementar la interfaz Detalle
// 3. Las clases TareaDesarrollo, TareaDiseno y TareaTesting que hereden de Tarea