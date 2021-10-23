<?php
abstract class EmpleadoTest extends \PHPUnit\Framework\TestCase{
	
	//Funcion crear que permite según los parámetros enviados crear un empleado
	public function crearDefault($nombre = "Julián", $apellido = "Rosalen", $dni = 33333333, $salario = "100000")
	{
		$empleado = new \App\Empleado ($nombre, $apellido, $dni , $salario);
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
		$this->assertEquals(33333333, $empleado->getDni());
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
		$this->assertEquals("No especificado", $empleado->getSector());
		
		$empleado->setSector("Backend"); //Edito el sector de trabajo
		$this->assertEquals("Backend", $empleado->getSector());
	}

	//Test para ToString
	public function testFuncionaToString()
	{
		$empleado = $this->crearDefault(); // No necesito asignarle valores porque mi función crear inicial ya los tiene por default
		$this->assertEquals("Julián Rosalen 33333333 100000", $empleado); //Php intentará convertir mi empleado a string y utilizara el metodo toString
	
		$this->assertEquals("Julián Rosalen 33333333 100000", $empleado->__toString()); //Llamo al método toString manualmente
	
		$this->assertEquals("Julián Rosalen 33333333 100000", $empleado . ""); //concateno empleado con un string , php intentará convertirlo  y utilizara el metodo toString
	
		$this->assertEquals("Julián Rosalen 33333333 100000", strval($empleado)); // Convierto a string con el metodo strlval y utilizara el metodo toString
	}

	//Test exception nombre vacío usando un string vacio
	public function testNombreVacio()
	{
		$this->expectException(\Exception::class); //Aviso que espero una excepción
		$this-> crearDefault("", "Rosalen", 33333333, "100000"); //Intento crear un empleado sin nombre 
	}

	//Test exception nombre vacío usando false como valor
	public function testNombreVacio2()
	{
		$this->expectException(\Exception::class); //Aviso que espero una excepción
		$this-> crearDefault(false, "Rosalen", 33333333, "100000"); //Intento crear un empleado sin nombre - el valor false es conciderado vacío - 
	}

	//Test exception apellido vacío usando un string vacio
	public function testApellidoVacio()
	{
		$this->expectException(\Exception::class); //Aviso que espero una excepción
		$this-> crearDefault("Julian", "", 33333333, "100000"); //Intento crear un empleado sin apellido 
	}
	
	//Test exception apellido vacío usando false como valor
	public function testApellidoVacio2()
	{
		$this->expectException(\Exception::class); //Aviso que espero una excepción
		$this-> crearDefault("Julian", false, 33333333, "100000"); //Intento crear un empleado sin apellido - el valor false es conciderado vacío - 
	}

	//Test exception dni vacío usando un string vacio
	public function testDNIVacio()
	{
		$this->expectException(\Exception::class); //Aviso que espero una excepción
		$this-> crearDefault("Julian", "Rosalen", "", "100000"); //Intento crear un empleado sin dni 
	}
	
	//Test exception dni vacío usando false como valor
	public function testDNIVacio2()
	{
		$this->expectException(\Exception::class); //Aviso que espero una excepción
		$this-> crearDefault("Julian", "Rosalen", null, "100000"); //Intento crear un empleado sin dni - el valor false es conciderado vacío - 
	}

	//Test exception dni vacío usando 0 como valor
	public function testDNIVacio3()
	{
		$this->expectException(\Exception::class); //Aviso que espero una excepción
		$this-> crearDefault("Julian", "Rosalen", 0, "100000"); //Intento crear un empleado sin dni - el valor 0 es conciderado vacío y además es verificado como excepción si el entero es 0 en la clase - 
	}

	//Test exception salario vacío usando un string vacio
	public function testSalarioVacio()
	{
		$this->expectException(\Exception::class); //Aviso que espero una excepción
		$this-> crearDefault("Julian", "Rosalen", 33333333, ""); //Intento crear un empleado sin salario 
	}
	
	//Test exception salario vacío usando false como valor
	public function testSalarioVacio2()
	{
		$this->expectException(\Exception::class); //Aviso que espero una excepción
		$this-> crearDefault("Julian", "Rosalen", 33333333, false); //Intento crear un empleado sin salario - el valor false es conciderado vacío - 
	}

	//Test dni con valores no numericos ni convertibles 
	public function testDniValoresNoNumericos()
	{
		$this->expectException(\Exception::class);//Aviso que espero una excepción
		$this-> crearDefault("Julian", "Rosalen", "A33333333", "100000"); //Agrego una letra al string numerico
	}

	//Test sector sin identificar
	public function testNoSeIdentificaSector()
	{
		$empleado = $this-> crearDefault("Julián","Rosalen", 33333333, "100000"); // Creo una nueva instancia para no enviar sector por default
		$this->assertEquals("No especificado", $empleado->getSector());
	}

}	
	