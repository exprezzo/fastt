<?php

require_once '../apps/'.$_PETICION->modulo.'/modelos/Producto_modelo.php';
class productos extends Controlador{
	var $modelo="Producto";
	
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