<?php
require_once '../'.$_PETICION->modulo.'/modelos/Almacen_modelo.php';
// require_once '../'.$_PETICION->modulo.'/vistas/pdf_almacen.php';
// require_once '../'.$_PETICION->modulo.'/vistas/modelo_almacen.php';
class Almacenes extends Controlador{
	var $modelo="Almacen";
	
	function nuevo(){
		$fields=array('id','nombre');
		$vista=$this->getVista();
		for($i=0; $i<sizeof($fields); $i++){
			$obj[$fields[$i]]='';
		}
		$vista->datos=$obj;
		
		global $_PETICION;
		$vista->mostrar('/'.$_PETICION->controlador.'/edicion');		
	}
	
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