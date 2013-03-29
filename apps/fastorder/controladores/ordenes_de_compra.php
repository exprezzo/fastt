<?php
require_once '../apps/'.$_PETICION->modulo.'/modelos/Orden_de_compra_modelo.php';
require_once '../apps/'.$_PETICION->modulo.'/modelos/DetalleDeOrden_modelo.php';
class ordenes_de_compra extends Controlador{
	var $modelo="Orden_de_compra";
	var $campos=array('id','idproveedor','fecha','vencimiento','idestado','fk_serie','folio','fk_almacen');
	
	function nuevo(){		
		$vista=$this->getVista();
		$vista->columnas=$this->campos;
		
		$campos=$this->campos;
		
						
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
	function getDetalles(){
		$detMod=new DetalleDeOrdenModelo();
		$id=$_REQUEST['id'];
		$res=$detMod->getProductosDeLaOrden($id);
		$res['totalRows']=sizeof($res['datos']);
		$res['rows']=$res['datos'];
		echo json_encode($res);
	}
	function editar(){	
		$vista=$this->getVista();
		$vista->columnas=$this->campos;
		
		
		$detMod=new DetalleDeOrdenModelo();
		$id=$_REQUEST['id'];
		$res=$detMod->getProductosDeLaOrden($id);		
		$vista->detalles=$res['datos'];
		
		
		
		return parent::editar();
	}
	
	function buscar(){
		return parent::buscar();
	}
}
?>