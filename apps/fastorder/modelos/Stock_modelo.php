<?php
class StockModelo extends Modelo{
	var $tabla="articulostock";
	var $campos=array('idarticuloalmacen','idarticulo','idalmacen','existencia','minimo','maximo','puntoreorden','idgrupo','grupoposicion');
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
		return parent::buscar($params);
	}
}
?>