<?php
class Orden_de_compraModelo extends Modelo{
	var $tabla="orden_compra";
	var $campos=array('id','idproveedor','fecha','vencimiento','idestado','fk_serie','folio','fk_almacen');
	
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