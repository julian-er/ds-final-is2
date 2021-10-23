<?php
require_once "EmpleadoTest.php";
class EmpleadoEventualTest extends EmpleadoTest
{
	public function crearDefault($nombre = "Julián",$apellido = "Rosalen",$dni = 38597346, $salario = "100000", $montos=array(5000,2000,1300,250))
	{
		$empleadoEventual = new \App\EmpleadoEventual($nombre, $apellido, $dni, $salario, $montos);
		return $empleadoEventual;
	}

    //Test para calcular comisión
	public function testCalcularComision()
   {
       $empleadoEv= $this->crearDefault(); // No necesito asignarle valores porque mi función crear inicial ya los tiene por default
       $this->assertEquals(106.875, $empleadoEv->calcularComision()); // La cuenta utilizando mis valores por defecto da 106.875
    }

} 