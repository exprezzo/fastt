<?php
require_once '../apps/'.$_PETICION->modulo.'/modelos/Orden_de_compra_modelo.php';
require_once '../apps/'.$_PETICION->modulo.'/modelos/DetalleDeOrden_modelo.php';
require_once '../apps/'.$_PETICION->modulo.'/modelos/Producto_modelo.php';

require_once '../apps/'.$_PETICION->modulo.'/modelos/Almacen_modelo.php';
require_once '../apps/'.$_PETICION->modulo.'/modelos/SerieOrdenCompra_modelo.php';
require_once '../apps/'.$_PETICION->modulo.'/modelos/Proveedor_modelo.php';
require_once '../apps/'.$_PETICION->modulo.'/modelos/EstadosOrdenCompra_modelo.php';

class ordenes_de_compra extends Controlador{
	var $modelo="Orden_de_compra";
	var $campos=array('id','idproveedor','fecha','vencimiento','idestado','fk_serie','folio','fk_almacen');
	
	function getArticulos(){
		$mod=new ProductoModelo();		
		
		$params=array(
			'id_almacen'=>empty($_REQUEST['idalmacen'])? 0 :$_REQUEST['idalmacen']
		);
		$res=$mod->busquedaPersonal($params);				
		
		echo json_encode($res);	
	}
	

	function nuevo(){		
		$this->cargarDatosAdicionales();
		
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
	// function getDetalles(){
		// $detMod=new DetalleDeOrdenModelo();
		// $id=$_REQUEST['id'];
		// $res=$detMod->getProductosDeLaOrden($id);
		// $res['totalRows']=sizeof($res['datos']);
		// $res['rows']=$res['datos'];
		// echo json_encode($res);
	// }
	private function cargarDatosAdicionales(){
		$vista=$this->getVista();
		$detMod=new ProveedorModelo();		
		$res=$detMod->buscar(array());		
		$vista->proveedores=$res['datos'];		
		
		$detMod=new SerieOrdenCompraModelo();		
		$res=$detMod->buscar(array());		
		$vista->series=$res['datos'];		
		
		$detMod=new AlmacenModelo();		
		$res=$detMod->buscar(array());		
		$vista->almacenes=$res['datos'];
		
		$detMod=new EstadosOrdenCompraModelo();		
		$res=$detMod->buscar(array());		
		$vista->estados=$res['datos'];
		
		
	}
	
	function editar(){	
		$vista=$this->getVista();
		$vista->columnas=$this->campos;
				
		$detMod=new DetalleDeOrdenModelo();
		$id=$_REQUEST['id'];
		$res=$detMod->getProductosDeLaOrden($id);		
		$vista->detalles=$res['datos'];
		
		$this->cargarDatosAdicionales();		
		
		return parent::editar();
	}
	
	function buscar(){
		return parent::buscar();
	}
}
?>