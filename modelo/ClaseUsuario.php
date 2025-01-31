<?php 
class ClaseUsuario{
	private $id;
	private $rol;
	private $usuario;
	private $contrasena;
	private $dui;
	private $empleado;
	private $estado;
	

	function __construct(
		$id,
		$rol,
		$usuario,
		$contrasena,
		$dui,
		$empleado,
		$estado){

		$this->id=$id;
		$this->rol=$rol;
		$this->usuario=$usuario;
		$this->contrasena=$contrasena;
		$this->dui=$dui;
		$this->empleado=$empleado;
		$this->estado=$estado;
		
	}

	function getId(){
		return $this->id;
	}
	function getRol(){
		return $this->rol;
	}
	function getUsuario(){
		return $this->usuario;
	}
	function getContrasena(){
		return $this->contrasena;
	}
	function getEmpleado(){
		return $this->empleado;
	}
	function getEstado(){
		return $this->estado;
	}
	function getDui(){
		return $this->dui;
	}
}

 ?>