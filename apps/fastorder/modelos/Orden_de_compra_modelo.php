<?php
class Orden_de_compraModelo extends Modelo{
	var $tabla="orden_compra";
	var $campos=array('id','idproveedor','fecha','vencimiento','idestado','fk_serie','folio','fk_almacen');
	
	function nuevo($params){
		return parent::nuevo($params);
	}
	function guardar($params){
		
		if ( isset($params['articulos']) ){
			$articulos=  $params['articulos'];
			unset($params['articulos']);
		}else{
			$articulos=array();
		}
		
		// echo 'guardar';
		// print_r($params);
		
		$resM= parent::guardar($params);
		
		if ( $resM['success']==false ){			
			return $resM;
		}
		
		$id=$resM['datos']['id'];
		
		$detMod=new DetalleDeOrdenModelo();
		foreach($articulos as $articulo){
			$articulo['fk_orden_compra']=$id;
			unset( $articulo['nombreProducto'] );
			unset( $articulo['nombreOrigen'] );
			unset( $articulo['almacen'] );
			
			if ( isset($articulo['eliminado']) && $articulo['eliminado']==true ){
				$res=$detMod->eliminar($articulo);
			}else{
				$res=$detMod->guardar($articulo);
			}			
		}
		$prods=$detMod->getProductosDeLaOrden($id);
		$resM['articulos']=$prods['datos'];
		
		return $resM;
	}
	function borrar($params){
		return parent::borrar($params);
	}
	function editar($params){
		return parent::obtener($params);
	}
	function buscar($params){
		return parent::buscar($params);
	}
}
?>