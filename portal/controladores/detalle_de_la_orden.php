<?php
require_once '../'.$_PETICION->modulo.'/modelos/DetalleDeOrden_modelo.php';
class detalle_de_la_orden extends Controlador{
	var $modelo="DetalleDeOrden";
	var $campos=array('id','fk_orden_compra','fk_articulo','idarticulopre','cantidad','fk_pedido_detalle','fk_producto_origen','fk_pedido','pedidoi','fk_almacen','pendiente');
	
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