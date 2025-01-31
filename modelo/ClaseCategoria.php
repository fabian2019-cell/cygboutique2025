<?php 
class ClaseCategoria{
	private $id_cat;
	private $nombre;
	private $descripcion;

	function __construct($id_cat, $nombre, $descripcion){

		$this->id_cat=$id_cat;
		$this->nombre=$nombre;
		$this->descripcion=$descripcion;
	}

	function getId_cat(){
		return $this->id_cat;
	}
	function getNombre(){
		return $this->nombre;
	}
	function getDescripcion(){
		return $this->descripcion;
	}
}


 ?>