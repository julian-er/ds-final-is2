<?php
require_once "EmpleadoTest.php";
class EmpleadoEventualTest extends EmpleadoTest
{
	public function crearDefault($nombre = "Julián",$apellido = "Rosalen",$dni = 33333333, $salario = "100000", $montos=array(5000,2000,1300,250))
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

    //Test para calcular Ingreso Total
    public function testFuncionaMetodoCalcularIngresoTotal()
    {
        $empleadoEv = $this->crearDefault();// No necesito asignarle valores porque mi función crear inicial ya los tiene por default
        $this->assertEquals(100106.875, $empleadoEv->calcularIngresoTotal());
    }

    //Test exception monto negativo o igual a 0
    public function testMontoInvalido()
    {
        $this->expectException(\Exception::class);//Aviso que espero una excepción
        $empleadoEv = $this->crearDefault("Julián", "Rosalen", 33333333, 10000, $array = array(15, 30, 60,-90)); //Creo el empleado con valores negativos
    }
} 