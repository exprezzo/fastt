<?php
require_once '../apps/'.$_PETICION->modulo.'/modelos/Serie_modelo.php';
class series extends Controlador{
	var $modelo="Serie";
	
	function nuevo(){		
		$fields=array('id','serie','folio_i','folio_f','sig_folio','es_default','idalmacen');
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