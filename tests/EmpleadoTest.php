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
	public function testFuncionaObtenerDni()
	{
		$empleado = $this-> crearDefault(); // No necesito asignarle valores porque mi función crear inicial ya los tiene por default
		$this->assertEquals(38597346, $empleado->getDni());
	}

	//Test para getSalario
	public function testFuncionaObtenerSalario()
	{
		$empleado = $this-> crearDefault(); // No necesito asignarle valores porque mi función crear inicial ya los tiene por default
		$this->assertEquals("100000", $empleado->getSalario());
	} 

	//Test para get y set sector
	// En este caso necesito crear una clase con un sector y demostrar que ese sector es el mismo, a continuación debo editar con
	// la funcion de set y demostrar que realmente ahora el valor es distinto
	public function testFuncionaSector()
	{
		$empleado = $this->crearDefault(); // No necesito asignarle valores porque mi función crear inicial ya los tiene por default
		$this->assertEquals("Frontend", $empleado->getSector());
		
		$empleado->setSector("Backend"); //Edito el sector de trabajo
		$this->assertEquals("Backend", $empleado->getSector());
	}

	//Test para ToString
	public function testFuncionaToString()
	{
		$empleado = $this->crearDefault(); // No necesito asignarle valores porque mi función crear inicial ya los tiene por default
		$this->assertEquals("Julián Rosalen 38597346 100000", $empleado); //Php intentará convertir mi empleado a string y utilizara el metodo toString
	
		$this->assertEquals("Julián Rosalen 38597346 100000", $empleado->__toString()); //Llamo al método toString manualmente
	
		$this->assertEquals("Julián Rosalen 38597346 100000", $empleado . ""); //concateno empleado con un string , php intentará convertirlo  y utilizara el metodo toString
	
		$this->assertEquals("Julián Rosalen 38597346 100000", strval($empleado)); // Convierto a string con el metodo strlval y utilizara el metodo toString
	}

	//Test exception nombre vacío usando un string vacio
	public function testNombreVacio()
	{
		$this->expectException(\Exception::class); //Aviso que espero una excepción
		$this->crearSinSector("", "Rosalen", 38597346, "100000"); //Intento crear un empleado sin nombre 
	}

	//Test exception nombre vacío usando false como valor
	public function testNombreVacio2()
	{
		$this->expectException(\Exception::class); //Aviso que espero una excepción
		$this->crearSinSector(false, "Rosalen", 38597346, "100000"); //Intento crear un empleado sin nombre - el valor false es conciderado vacío - 
	}


	//Test sector sin identificar
	public function testNoSeIdentificaSector()
	{
		$empleado = $this->crearSinSector( "Julián","Rosalen", 38597346, "100000"); // Creo una nueva instancia para no enviar sector por default
		$this->assertEquals("No especificado", $empleado->getSector());
	}

}	
	