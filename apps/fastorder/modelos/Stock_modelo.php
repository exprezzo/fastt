<?php
class StockModelo extends Modelo{
	var $tabla="articulostock";
	var $pk='idarticuloalmacen';
	function nuevo($params){
		return parent::nuevo($params);
	}
	function guardar($params){
		return parent::guardar($params);
	}
	function borrar($params){
		return parent::borrar($params);
	}
	function editar($params){
		return parent::obtener($params);
	}
	function buscar($params){
		return parent::paginar($params);
	}
}
?>