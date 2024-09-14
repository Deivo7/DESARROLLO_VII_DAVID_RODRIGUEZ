<?php
require_once 'Gerente.php';
require_once 'Desarrollador.php';

class Empresa {
    private $empleados = [];

    public function agregarEmpleado(Empleado $empleado) {
        $this->empleados[] = $empleado;
    }

    public function listarEmpleados() {
        foreach ($this->empleados as $empleado) {
            echo "Empleado: " . $empleado->getNombre() . "\n";
        }
    }

    public function calcularNominaTotal() {
        $total = 0;
        foreach ($this->empleados as $empleado) {
            $total += $empleado->getSalarioBase();
        }
        return $total;
    }

    public function evaluarEmpleados() {
        foreach ($this->empleados as $empleado) {
            if ($empleado instanceof Evaluable) {
                echo $empleado->evaluarDesempenio() . "\n";
            }
        }
    }

    // Método para aumentar salarios
    public function aumentarSalarios($porcentaje) {
        foreach ($this->empleados as $empleado) {
            if ($empleado instanceof Evaluable) {
                $empleado->aumentarSalario($porcentaje);
            }
        }
    }

    // Método para guardar empleados en un archivo JSON
    public function guardarEmpleados($archivo) {
        $data = [];
        foreach ($this->empleados as $empleado) {
            $data[] = [
                'nombre' => $empleado->getNombre(),
                'idEmpleado' => $empleado->getIdEmpleado(),
                'salarioBase' => $empleado->getSalarioBase(),
                'tipo' => get_class($empleado)
            ];
        }
        file_put_contents($archivo, json_encode($data));
    }

    // Método para cargar empleados desde un archivo JSON
    public function cargarEmpleados($archivo) {
        if (!file_exists($archivo)) {
            echo "El archivo no existe.\n";
            return;
        }

        $data = json_decode(file_get_contents($archivo), true);
        foreach ($data as $empleadoData) {
            $tipo = $empleadoData['tipo'];
            if ($tipo == 'Gerente') {
                $empleado = new Gerente($empleadoData['nombre'], $empleadoData['idEmpleado'], $empleadoData['salarioBase'], 'Ventas');
            } elseif ($tipo == 'Desarrollador') {
                $empleado = new Desarrollador($empleadoData['nombre'], $empleadoData['idEmpleado'], $empleadoData['salarioBase'], 'PHP', 'Senior');
            }
            $this->agregarEmpleado($empleado);
        }
    }
}
?>