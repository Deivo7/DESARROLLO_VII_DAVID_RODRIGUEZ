<?php
require_once 'Empresa.php';
require_once 'Gerente.php';
require_once 'Desarrollador.php';

$empresa = new Empresa();

// Crear instancias de empleados
$gerente = new Gerente("Carlos Perez", "101", 5000, "Ventas");
$desarrollador = new Desarrollador("Ana López", "102", 4000, "PHP", "Senior");

// Asignar bono al gerente
$gerente->asignarBono(1000);

// Agregar empleados a la empresa
$empresa->agregarEmpleado($gerente);
$empresa->agregarEmpleado($desarrollador);

// Listar empleados
$empresa->listarEmpleados();

// Calcular la nómina total
echo "Nómina total: " . $empresa->calcularNominaTotal() . "\n";

// Evaluar empleados
$empresa->evaluarEmpleados();

// Aumentar salarios en un 10%
$empresa->aumentarSalarios(10);
echo "Nómina total después del aumento: " . $empresa->calcularNominaTotal() . "\n";

// Guardar empleados en un archivo JSON
$empresa->guardarEmpleados('empleados.json');

// Cargar empleados desde el archivo JSON
$empresaCargada = new Empresa();
$empresaCargada->cargarEmpleados('empleados.json');
$empresaCargada->listarEmpleados();
?>
