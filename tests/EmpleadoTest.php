<?php
class EmpleadoTest extends \PHPUnit\Framework\TestCase{
	
	//Funcion crear que permite según los parámetros enviados crear un empleado
	public function crearDefault($nombre = "Julián",$apellido = "Rosalen",$dni = 38597346, $salario = "100000", $sector = "Frontend")
	{
		$empleado = new \App\Empleado($nombre, $apellido, $dni , $salario , $sector);
		return $empleado;
	}

	//Funcion crear que permite según los parámetros enviados crear un empleado sin el sector
	public function crearSinSector($nombre ,$apellido ,$dni , $salario )
	{
		$empleado = new \App\Empleado($nombre, $apellido, $dni , $salario);
		return $empleado;
	}


	//Test para getNombreApellido
	public function testObtenerNombreApellido()
	{
		$empleado = $this-> crearDefault(); // No necesito asignarle valores porque mi función crear inicial ya los tiene por default
		$this->assertEquals("Julián Rosalen", $empleado->getNombreApellido());
	}

	//Test para getDni
	public function testFuncionaMetodoDni()
	{
		$empleado = $this-> crearDefault(); // No necesito asignarle valores porque mi función crear inicial ya los tiene por default
		$this->assertEquals(38597346, $empleado->getDni());
	}

	//Test sector sin identificar
	public function testNoSeIdentificaSector()
	{
		$empleado = $this->crearSinSector( "Julián","Rosalen", 38597346, "100000"); // Creo una nueva instancia para no enviar sector por default
		$this->assertEquals("No especificado", $empleado->getSector());
	}

}	
	