<?php
class CatalogoBaseModelo extends Modelo{
	var $tabla="system_catalogos";
	var $campos=array('id','nombre','controlador','modelo','tabla','icono','titulo_nuevo','titulo_edicion','titulo_busqueda','msg_creado','msg_actualizado','pregunta_eliminar','msg_eliminado','msg_cambios');
	
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