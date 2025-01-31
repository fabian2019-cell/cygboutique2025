<?php 
class ClaseProducto_compra{
	private $producto;
	private $compra;
	private $precio_producto;
	private $cantidad;
	private $subtotal;

	function __construct(
		$producto,
		$compra,
		$precio_producto,
		$cantidad,
		$subtotal
	){

		$this->producto=$producto;
		$this->compra=$compra;
		$this->precio_producto=$precio_producto;
		$this->cantidad=$cantidad;
		$this->subtotal=$subtotal;
	}

	function getProducto_id(){
		return $this->producto;
	}
	function getCompra_id(){
		return $this->compra;
	}
	function getPrecio_producto(){
		return $this->precio_producto;
	}
	function getCantidad(){
		return $this->cantidad;
	}
	function getSubtotal(){
		return $this->subtotal;
	}
}

 ?>