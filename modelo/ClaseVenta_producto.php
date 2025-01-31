<?php 
class ClaseVenta_producto{
	private $id;
	private $id_venta;
	private $id_producto;
	private $precio_venta;
	private $cantidad_des;
	private $cantidad;
	private $subtotal;

	function __construct(
		$id,
		$id_venta,
		$id_producto,
		$precio_venta,
		$cantidad_des,
		$cantidad,
		$subtotal
	){

		$this->id=$id;
		$this->id_venta=$id_venta;
		$this->id_producto=$id_producto;
		$this->precio_venta=$precio_venta;
		$this->cantidad_des=$cantidad_des;
		$this->cantidad=$cantidad;
		$this->subtotal=$subtotal;
	}

	function getId(){
		return $this->id;
	}
	function getId_venta(){
		return $this->id_venta;
	}
	function getId_producto(){
		return $this->id_producto;
	}
	function getPrecio_venta(){
		return $this->precio_venta;
	}
	function getCantidad_des(){
		return $this->cantidad_des;
	}
	function getCantidad(){
		return $this->cantidad;
	}
	function getSubtotal(){
		return $this->subtotal;
	}
}

 ?>