<?php 
class ClaseEmpleado{
	private $id_empleado;
	private $nombres;
	private $apellidos;
	private $dui;
	private $direccion;
	private $telefono;
	private $estado;
	private $cargo;

	function __construct(
		$id_empleado,
		$nombres,
		$apellidos,
		$dui,
		$direccion,
		$telefono,
		$estado,$cargo){

		$this->id_empleado=$id_empleado;
		$this->nombres=$nombres;
		$this->apellidos=$apellidos;
		$this->dui=$dui;
		$this->direccion=$direccion;
		$this->telefono=$telefono;
		$this->estado=$estado;
		$this->cargo=$cargo;
	}

	function getId_empleado(){
		return $this->id_empleado;
	}
	function getNombres(){
		return $this->nombres;
	}
	function getApellidos(){
		return $this->apellidos;
	}
	function getDui(){
		return $this->dui;
	}
	function getDireccion(){
		return $this->direccion;
	}
	function getTelefono(){
		return $this->telefono;
	}
	function getEstado(){
		return $this->estado;
	}
	function getCargo(){
		return $this->cargo;
	}

}

 ?>