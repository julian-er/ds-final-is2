<?php
require_once 'EmpleadoTest.php';
	
class EmpleadoPermanenteTest extends EmpleadoTest{
    
    public function crearDefault($nombre="Julián", $apellido="Rosalen", $dni=33333333, $salario=100000, $fechaIngreso=null){
        $fecha = new \DateTime();
        $empleadoPe = new \App\EmpleadoPermanente($nombre, $apellido, $dni, $salario, $fechaIngreso);
        return $empleadoPe;
    }

    //Test para  crearDefault y getFechaIngreso
    public function testCrearIngreso(){
        $fechaActual = new DateTime(); //Inicializo un nuevo objeto Date Time
        $empleadoPe= $this->crearDefault(); // No necesito asignarle valores porque mi función crear inicial ya los tiene por default
        $this->assertEquals($fechaActual->format('Y-m-d'), $empleadoPe->getFechaIngreso()->format('Y-m-d'));
    }
    //Test para calcularComision
    public function testCalcularComisionAntiguedad(){
        $ingreso = new DateTime(); //Inicializo un nuevo objeto Date Time
        $ingreso->modify('-10 years'); // Modifico el ingreso en 10 años
        $empleadoPe= $this->crearDefault("Julián", "Rosalen", 33333333, 100000, $ingreso); 
        $this->assertEquals("10%",$empleadoPe->calcularComision());
    }
    //Test para calcularIngresoTotal
    public function testCalcularIngresoTotal(){
        $ingreso = new DateTime();//Inicializo un nuevo objeto Date Time
        $ingreso->modify('-10 years'); // Modifico el ingreso en 10 años
        $empleadoPe= $this->crearDefault("Julián", "Rosalen", 33333333, 100000, $ingreso); 
        $this->assertEquals(110000,$empleadoPe->calcularIngresoTotal());
    }
    //Test para calcularAntiguedad
    public function testAntiguedad(){
        $ingreso = new DateTime(); //Inicializo un nuevo objeto Date Time
        $ingreso->modify('-10 years'); // Modifico el ingreso en 10 años
        $empleadoPe= $this->crearDefault("Julián", "Rosalen", 33333333, 100000, $ingreso);
        $this->assertEquals(10,$empleadoPe->calcularAntiguedad());
    }
    
    //Test para demostrar que si no ingresa fecha el valor es el dia actual y la antiguedad es igual a 0
    public function testFechaSinProporcionar()
    {
        $empleadoPe = $this->crearDefault("Julián", "Rosalen", 33333333, 100000);//Inicializo sin fecha
        $fecha = new DateTime(); //Inicializo un nuevo objeto Date Time
        $this->assertEquals(date_format($fecha, 'y-m-d'), date_format($empleadoPe->getFechaIngreso(), 'y-m-d')); // si la fecha es nula la clase retorna la fecha de hoy ($fecha)
        $this->assertEquals(0, $empleadoPe->calcularAntiguedad()); 
    }

    //Tests excepción fecha de ingreso posterior a hoy
    public function testFechaPosterior(){
        $ingreso = new DateTime(); //Inicializo un nuevo objeto Date Time
        $ingreso->modify('+10 years'); //le sumo 10 años a la fecha creada
        $this->expectException(\Exception::class); //Aviso que espero una excepción
        $empleadoPe= $this->crearDefault("Julián", "Rosalen", 33333333, 100000, $ingreso); //tiro la excepcion al instanciar
    }
    
}