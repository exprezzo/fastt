<?php

require_once '../apps/'.$_PETICION->modulo.'/modelos/Almacen_modelo.php';
class Almacenes extends Controlador{
	var $modelo="Almacen";
	
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