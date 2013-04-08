<?php
require_once '../'.$_PETICION->modulo.'/modelos/Producto_modelo.php';
require_once '../'.$_PETICION->modulo.'/modelos/producto_tipo_modelo.php';
class productos extends Controlador{
	var $modelo="Producto";
	
	function nuevo(){		
		$vista=$this->getVista();
		$tipoMod=new producto_tipoModelo();
		$res=$tipoMod->buscar(array(
			'limit'=>10000,
			'start'=>0
		));
		$vista->tipos=$res['datos'];
		
		$fields=array('id','nombre','codigo','tipo');
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
		$vista=$this->getVista();
		$tipoMod=new producto_tipoModelo();
		$res=$tipoMod->buscar(array(
			'limit'=>10000,
			'start'=>0
		));
		$vista->tipos=$res['datos'];
		
		return parent::editar();
	}
	function buscar(){
		return parent::buscar();
	}
}
?>