<?php 
class ClaseVenta{
	private $id_venta;
	private $fecha_venta;
	private $cliente;
	private $empleado;
	private $total_venta;

	function __construct($id_venta, $fecha_venta, $cliente, $empleado, $total_venta){

		$this->id_venta=$id_venta;
		$this->fecha_venta=$fecha_venta;
		$this->cliente=$cliente;
		$this->empleado=$empleado;
		$this->total_venta=$total_venta;
	}
	function getId_venta(){
		return $this->id_venta;
	}
	function getFecha_venta(){
		return $this->fecha_venta;
	}
	function getCliente(){
		return $this->cliente;
	}
	function getEmpleado(){
		return $this->empleado;
	}
	function getTotal_venta(){
		return $this->total_venta;
	}
}


 ?>