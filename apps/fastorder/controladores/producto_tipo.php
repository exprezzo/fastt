<?php
require_once '../apps/'.$_PETICION->modulo.'/modelos/producto_tipo_modelo.php';
class producto_tipo extends Controlador{
	var $modelo="producto_tipo";
	
	function nuevo(){		
		$fields=array('id','nombre','descripcion');
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