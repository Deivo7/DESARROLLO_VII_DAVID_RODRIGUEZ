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
            switch ($tareaData['tipo']) {
                case 'desarrollo':
                    $tarea = new TareaDesarrollo($tareaData);
                    break;
                case 'diseno':
                    $tarea = new TareaDiseno($tareaData);
                    break;
                case 'testing':
                    $tarea = new TareaTesting($tareaData);
                    break;
                default:
                    $tarea = new Tarea($tareaData); // Caso por defecto
            }
            $this->tareas[] = $tarea;
        }
        
        return $this->tareas;
    }

    // Implementar métodos adicionales
    public function agregarTarea($tarea) {
        $this->tareas[] = $tarea;
        $this->guardarTareas();
    }

    public function eliminarTarea($id) {
        $this->tareas = array_filter($this->tareas, function ($tarea) use ($id) {
            return $tarea->id != $id;
        });
        $this->guardarTareas();
    }

    public function actualizarTarea($tareaActualizada) {
        foreach ($this->tareas as &$tarea) {
            if ($tarea->id == $tareaActualizada->id) {
                $tarea = $tareaActualizada;
                break;
            }
        }
        $this->guardarTareas();
    }

    public function actualizarEstadoTarea($id, $nuevoEstado) {
        foreach ($this->tareas as &$tarea) {
            if ($tarea->id == $id) {
                $tarea->estado = $nuevoEstado;
                break;
            }
        }
        $this->guardarTareas();
    }

    public function buscarTareasPorEstado($estado) {
        return array_filter($this->tareas, function ($tarea) use ($estado) {
            return $tarea->estado == $estado;
        });
    }

    private function guardarTareas() {
        file_put_contents('tareas.json', json_encode($this->tareas));
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


// Clase TareaDiseño
class TareaDiseno extends Tarea {
    public $herramientaDiseno;

    public function __construct($datos) {
        parent::__construct($datos);
        $this->herramientaDiseno = $datos['herramientaDiseno'] ?? '';
    }

    public function obtenerDetallesEspecificos(): string {
        return "Herramienta de Diseño: $this->herramientaDiseno";
    }
}


// Clase TareaTesting
class TareaTesting extends Tarea {
    public $tipoTest;

    public function __construct($datos) {
        parent::__construct($datos);
        $this->tipoTest = $datos['tipoTest'] ?? '';
    }

    public function obtenerDetallesEspecificos(): string {
        return "Tipo de Test: $this->tipoTest";
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