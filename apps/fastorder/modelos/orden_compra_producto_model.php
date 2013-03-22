<?php

class OrdenCompraProductoModel extends Modelo{
	var $tabla='orden_compra_productos';
	var $id='id';
	
	
	function guardar($params){
		$dbh=$this->getConexion();
		
		$id			=empty($params[ $this->ids[$this->indexTabla] ] )? 0 : $params[ $this->ids[$this->indexTabla] ];
		$fk_pedido	=$params['fk_orden_compra'];
		$fk_articulo	=$params['fk_articulo'];
		$fk_um	=$params['fk_um'];
		$cantidad	=$params['pedido'];
				
		if ( empty($id) ){
			//           CREAR
			$sql='INSERT INTO '.$this->tablas[$this->indexTabla].' SET fk_articulo=:fk_articulo, fk_um= :fk_um, cantidad=:cantidad, fk_pedido=:fk_pedido';
			$sth = $dbh->prepare($sql);
			$sth->bindValue(":fk_articulo", $fk_articulo, PDO::PARAM_INT);
			$sth->bindValue(":fk_um", $fk_um,PDO::PARAM_INT);
			$sth->bindValue(":cantidad", $cantidad,PDO::PARAM_INT);
			$sth->bindValue(":fk_pedido", $fk_pedido,PDO::PARAM_INT);
			$msg='Pedido Guardado';
		}else{
			//	         ACTUALIZAR
			$sql='UPDATE '.$this->tablas[$this->indexTabla].' SET fk_articulo=:fk_articulo, fk_um= :fk_um, cantidad=:cantidad
			WHERE '.$this->ids[$this->indexTabla].'=:id';
			$sth = $dbh->prepare($sql);
			$sth->bindValue(":fk_articulo", $fk_articulo, PDO::PARAM_INT);
			$sth->bindValue(":fk_um", $fk_um,PDO::PARAM_INT);
			$sth->bindValue(":cantidad", $cantidad,PDO::PARAM_INT);
			$sth->bindValue(":id",$id,PDO::PARAM_INT);
			$msg='Pedido Actualizado';
		}
			
		$exito = $sth->execute();		
		
		if (!$exito){
			//Logger->logear   		PENDIENTE: LOGEAR
			$resp['success']=false;
			$error=$sth->errorInfo();
			$msg    = $error[2];
			$pedido=$params;
		}else{
			// if ( empty($id) ) $id=$dbh->lastInsertId();
			// $pedido=$this->getPedido($id);
		}
		
		return array(
			'success'=>$exito,
			'msg'=>$msg
			// 'datos'=>$pedido
		);		
		
		return $res;
	}
	
	
	function paginar($params){		
		$start=$params['start'];
		$pageSize=$params['limit'];
		$fk_orden_compra=$params['fk_orden_compra'];
		// $idalmacen=empty($params['idalmacen'])? 0 :intval( $params['idalmacen']);
		
		$sql='select COUNT(pedprod.id) as total FROM '.$this->tabla.' pedprod		
		WHERE pedprod.fk_orden_compra=:fk_orden_compra';		
		
		$model=$this;
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$sth->bindValue(':fk_orden_compra',$fk_orden_compra, PDO::PARAM_INT);
		$datos=$model->execute( $sth );
		
		if (!$datos['success']) return $datos;
		
		$total=$datos['datos'][0]['total'];
		//, maximo maximo, minimo, reorden, iinicial, sugerido, pedido, pendiente,fk_articulo, id_tmp, fk_um,id id
		$sql=<<<EOT
		SELECT orpro.id id,alm.nombre as almacen_pi, orpro.cantidad cantidad,0 as pendiente,
	procom.codigo codigo,procom.nombre producto, procom.id idproducto,procom.nombre producto,
	CONCAT('{"nombre":"',procom.nombre,'","id":',procom.id ,'}') productoJson,
	arsto.maximo, arsto.minimo, arsto.puntoreorden, arsto.existencia,
	arsto_pi.maximo maximo_pi, arsto_pi.minimo minimo_pi, arsto_pi.puntoreorden reorden_pi, arsto_pi.existencia inicial_pi, arsto_pi.idalmacen idalmacen_pi,
 pro_pi.nombre producto_pi, pro_pi.id pro_pi,
0 as sugerido_pi, pedpro.cantidad cantidad_pi,orpro.fk_pedido_detalle fk_pedido_detalle
FROM orden_compra_productos orpro
LEFT JOIN orden_compra ordcom ON ordcom.id=orpro.fk_orden_compra
LEFT JOIN productos procom ON procom.id=orpro.fk_articulo
LEFT JOIN articulostock arsto  ON arsto.idarticulo = orpro.fk_articulo AND arsto.idalmacen =  ordcom.fk_almacen
LEFT JOIN articulostock arsto_pi  ON arsto_pi.idarticulo = orpro.fk_articulo AND arsto_pi.idalmacen =  orpro.fk_almacen
LEFT JOIN productos pro_pi ON pro_pi.id=orpro.fk_producto_origen
LEFT join almacenes alm ON alm.id=orpro.fk_almacen
LEFT JOIN pedidos_productos pedpro ON pedpro.id = orpro.fk_pedido_detalle
where orpro.fk_orden_compra=:fk_orden_compra  ORDER BY arsto.idgrupo, arsto.grupoposicion,orpro.fk_articulo limit :start,:limit
EOT;
		
				
		$con=$model->getConexion(); 
		$sth=$con->prepare($sql); 
		$sth->bindValue(':start',intval($start), PDO::PARAM_INT); 
		$sth->bindValue(':limit',intval($pageSize), PDO::PARAM_INT);  
		$sth->bindValue(':fk_orden_compra',$fk_orden_compra, PDO::PARAM_INT); 
		// $sth->bindValue(':idalmacen',$idalmacen, PDO::PARAM_INT); 
				
		$datos=$model->execute($sth);
		
		
		if (!$datos['success']) return $datos;
		
		return array(
			'success'=>true,
			'totalRows'=>$total,
			'rows'=>$datos['datos']
		);
	}
	
}
?>