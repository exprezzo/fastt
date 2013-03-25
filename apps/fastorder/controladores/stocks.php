<?php
require_once '../apps/'.$_PETICION->modulo.'/modelos/Stock_modelo.php';
class stocks extends Controlador{
	var $modelo="Stock";
	
	function nuevo(){		
		$fields=array('idarticuloalmacen','idarticulo','idalmacen','existencia','minimo','maximo','puntoreorden','idgrupo','grupoposicion');
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