<?php

require_once '../apps/'.$_PETICION->modulo.'/modelos/Serie_modelo.php';
class series extends Controlador{
	var $modelo="Serie";
	
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