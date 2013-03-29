<?php
class DetalleDeOrdenModelo extends Modelo{
	var $tabla="orden_compra_productos";
	var $campos=array('id','fk_orden_compra','fk_articulo','idarticulopre','cantidad','fk_pedido_detalle','fk_producto_origen','fk_pedido','pedidoi','fk_almacen','pendiente');
	
	function nuevo($params){
		return parent::nuevo($params);
	}
	function guardar($params){
		return parent::guardar($params);
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
	function getProductosDeLaOrden($fk_orden_compra){	
		$con = $this->getConexion();		
		$sql = 'SELECT d.id,d.fk_orden_compra,d.fk_articulo, p.nombre as nombreProducto, d.idarticulopre,d.cantidad,d.fk_pedido_detalle,
		d.fk_producto_origen,po.nombre as nombreOrigen, d.fk_pedido,d.pedidoi,d.fk_almacen,d.pendiente ,a.nombre almacen
		FROM '.$this->tabla.'  d
		LEFT JOIN productos p ON p.id=d.fk_articulo
		LEFT JOIN productos po ON po.id=d.fk_producto_origen
		LEFT JOIN almacenes a ON a.id = d.fk_almacen
		WHERE fk_orden_compra=:fk_orden_compra ORDER BY fk_articulo ASC';
				
		$sth = $con->prepare($sql);
		$sth->bindValue(':fk_orden_compra',$fk_orden_compra,PDO::PARAM_INT);
		
		$exito = $sth->execute();

		$modelos = $sth->fetchAll(PDO::FETCH_ASSOC);				
		if ( !$exito ){
			throw new Exception("Error listando: ".$sql); //TODO: agregar numero de error, crear una exception MiEscepcion
		}
							
		return array(
			'success'=>true,			
			'datos'=>$modelos
		);
	}
}
?>