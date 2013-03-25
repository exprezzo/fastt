<?php
require_once '../apps/'.$_PETICION->modulo.'/modelos/unidademedida_modelo.php';
class unidademedida extends Controlador{
	var $modelo="unidademedida";
	
	function nuevo(){		
		$fields=array('id','abrev','descripcion');
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