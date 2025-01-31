<?php 
class ClaseProveedor{
	private $id_proveedor;
	private $nombre;
	private $empresa;
	private $telefono;

	function __construct(
		$id_proveedor,
	 $nombre,
	 $empresa,
	 $telefono){

		$this->id_proveedor=$id_proveedor;
		$this->nombre=$nombre;
		$this->empresa=$empresa;
		$this->telefono=$telefono;
	}

	function getId_proveedor(){
		return $this->id_proveedor;
	}
	function getNombre(){
		return $this->nombre;
	}
	function getEmpresa(){
		return $this->empresa;
	}
	function getTelefono(){
		return $this->telefono;
	}
}

 ?>