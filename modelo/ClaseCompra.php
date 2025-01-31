<?php 
class ClaseCompra{
	private $id_compra;
	private $fecha;
	private $proveedor;
	private $subtotal;

	function __construct($id_compra,  $fecha,$proveedor, $subtotal){

		$this->id_compra=$id_compra;
		$this->fecha=$fecha;
		$this->proveedor=$proveedor;
		$this->subtotal=$subtotal;
		
	}
	function getId_compra(){
		return $this->id_compra;
	}
	function getFecha(){
		return $this->fecha;
	}
	function getProveedor(){
		return $this->proveedor;
	}
	function getSubtotal(){
		return $this->subtotal;
	}
	
}


 ?>