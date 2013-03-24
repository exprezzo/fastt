<?php

require_once '../apps/'.$_PETICION->modulo.'/modelos/EstadoPedido_modelo.php';
class EstadoPedidos extends Controlador{
	var $modelo="EstadoPedido";
	
	// function nuevo(){
		// return parent::nuevo();
	// }
	
	function guardar(){
		return parent::guardar();
	}
	function borrar(){
		return parent::borrar();
	}
	function editar(){
		return parent::editar();
	}
	function buscar(){
		return parent::buscar();
	}
}
?>