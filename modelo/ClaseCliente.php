<?php 
class ClaseCliente{
	private $id_cliente;
	private $nombres;
	private $apellidos;
	private $dui;
	private $telefono;
	private $fecha_registro;

	function __construct(
		$id_cliente,
		$nombres,
		$apellidos,
		$dui,
		$telefono,
		$fecha_registro){

		$this->id_cliente=$id_cliente;
		$this->nombres=$nombres;
		$this->apellidos=$apellidos;
		$this->dui=$dui;
		$this->telefono=$telefono;
		$this->fecha_registro=$fecha_registro;
	}

	function getId_cliente(){
		return $this->id_cliente;
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
	function getTelefono(){
		return $this->telefono;
	}
	function getFecha_registro(){
		return $this->fecha_registro;
	}
}

 ?>