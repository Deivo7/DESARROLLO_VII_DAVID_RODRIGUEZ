<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';

class Gerente extends Empleado implements Evaluable {
    private $departamento;
    private $bono;

    public function __construct($nombre, $idEmpleado, $salarioBase, $departamento) {
        parent::__construct($nombre, $idEmpleado, $salarioBase);
        $this->departamento = $departamento;
        $this->bono = 0;
    }

    public function asignarBono($bono) {
        $this->bono = $bono;
    }

    public function getBono() {
        return $this->bono;
    }

    public function getDepartamento() {
        return $this->departamento;
    }

    // Implementación del método evaluarDesempenio
    public function evaluarDesempenio() {
        return "Evaluación del gerente: Satisfactoria";
    }

    // Método para aumentar salario basado en evaluación
    public function aumentarSalario($porcentaje) {
        $nuevoSalario = $this->getSalarioBase() * (1 + $porcentaje / 100);
        $this->setSalarioBase($nuevoSalario);
    }
}
?>
