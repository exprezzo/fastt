<?php
require_once '../apps/'.$_PETICION->modulo.'/modelos/Proveedor_modelo.php';
class proveedores extends Controlador{
	var $modelo="Proveedor";
	
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