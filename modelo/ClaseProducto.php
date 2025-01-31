<?php 
class ClaseProducto{
	private $id_prod;
	private $codigo;
	private $estilo;
	private $nombre;
	private $marca;
	private $color;
	private $talla;
	private $descripcion;
	private $costo;
	private $cantidad_gan;
	private $id_cat;
	private $proveedor;
	private $stock_min;

	function __construct(
		$id_prod,
		$codigo,
		$estilo,
		$nombre,
		$marca,
		$color,
		$talla,
		$descripcion,
		$costo,
		$cantidad_gan,
		$id_cat,
		$proveedor,
		$stock_min){

		$this->id_prod=$id_prod;
		$this->codigo=$codigo;
		$this->estilo=$estilo;
		$this->nombre=$nombre;
		$this->marca=$marca;
		$this->color=$color;
		$this->talla=$talla;
		$this->descripcion=$descripcion;
		$this->costo=$costo;
		$this->cantidad_gan=$cantidad_gan;
		$this->id_cat=$id_cat;
		$this->proveedor=$proveedor;
		$this->stock_min=$stock_min;

	}
	

	function getId_prod(){
		return $this->id_prod;
	}
	function getCodigo(){
		return $this->codigo;
	}
	function getEstilo(){
		return $this->estilo;
	}
	function getNombre(){
		return $this->nombre;
	}
	function getMarca(){
		return $this->marca;
	}
	function getColor(){
		return $this->color;
	}
	function getTallas(){
		return $this->talla;
	}
	function getDescripcion(){
		return $this->descripcion;
	}
	function getCosto(){
		return $this->costo;
	}
	function getCantidad_gan(){
		return $this->cantidad_gan;
	}
	function getId_cat(){
		return $this->id_cat;
	}
	function getProveedor(){
		return $this->proveedor;
	}
	function getStock_min(){
		return $this->stock_min;
	}
}

 ?>