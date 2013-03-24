<?php

require_once '../apps/'.$_PETICION->modulo.'/modelos/Stock_modelo.php';
class stocks extends Controlador{
	var $modelo="Stock";
	
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