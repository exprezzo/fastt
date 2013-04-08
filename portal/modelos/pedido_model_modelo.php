<?php
class pedido_modelModelo extends Modelo{
	var $tabla="pedidos";
	var $campos=array('id','fk_almacen','fecha','vencimiento','idestado','fk_serie','folio');
	
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