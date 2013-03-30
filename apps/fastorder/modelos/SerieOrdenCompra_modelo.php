<?php
class SerieOrdenCompraModelo extends Modelo{
	var $tabla="orden_compra_series";
	var $campos=array('id','serie','folio_i','folio_f','sig_folio','es_default','idalmacen');
	
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