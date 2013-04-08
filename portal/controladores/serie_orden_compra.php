<?php
require_once '../'.$_PETICION->modulo.'/modelos/SerieOrdenCompra_modelo.php';
class serie_orden_compra extends Controlador{
	var $modelo="SerieOrdenCompra";
	var $campos=array('id','serie','folio_i','folio_f','sig_folio','es_default','idalmacen');
	
	function nuevo(){		
		$campos=$this->campos;
		$vista=$this->getVista();				
		for($i=0; $i<sizeof($campos); $i++){
			$obj[$campos[$i]]='';
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