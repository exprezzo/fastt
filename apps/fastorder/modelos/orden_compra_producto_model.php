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
		$idalmacen=empty($params['idalmacen'])? 0 :intval( $params['idalmacen']);
		
		$sql='select COUNT(pedprod.id) as total FROM '.$this->tabla.' pedprod		
		WHERE pedprod.fk_orden_compra=:fk_orden_compra';		
		
		$model=$this;
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$sth->bindValue(':fk_orden_compra',$fk_orden_compra, PDO::PARAM_INT);
		$datos=$model->execute($sth);
		
		if (!$datos['success']) return $datos;
		
		$total=$datos['datos'][0]['total'];
		//, maximo maximo, minimo, reorden, iinicial, sugerido, pedido, pendiente,fk_articulo, id_tmp, fk_um,id id
		$sql = 'SELECT pedprod.*,prod.nombre as nombre,pre.descripcion as presentacion,pre.idarticulopre, prod.codigo codigo, 
		prod.nombre producto,a.nombre as almacen,o.nombre origen,
		sto.maximo, sto.minimo, sto.puntoreorden, sto.existencia,pedprod.cantidad pedido ,sto.maximo - sto.existencia sugerido,((sto.puntoreorden - sto.existencia)- pedprod.cantidad) pendiente,
		sto.grupoposicion, gpo.nombre nombreGpo
		FROM '.$this->tabla.' pedprod		
		LEFT JOIN productos prod ON pedprod.fk_articulo = prod.id
		LEFT JOIN productos o ON o.id = pedprod.fk_producto_origen
		LEFT JOIN almacenes  a ON a.id = pedprod.fk_almacen
		LEFT JOIN articulopre pre ON pedprod.idarticulopre =pre.idarticulopre
		LEFT JOIN articulostock sto ON sto.idarticulo= pedprod.fk_articulo AND sto.idalmacen=:idalmacen
		LEFT JOIN grupo_de_productos gpo ON  gpo.id=sto.idgrupo
		WHERE pedprod.fk_orden_compra=:fk_orden_compra ORDER BY sto.idgrupo, sto.grupoposicion,pedprod.fk_articulo limit :start,:limit';		
				
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		 $sth->bindValue(':start',intval($start), PDO::PARAM_INT);
		 $sth->bindValue(':limit',intval($pageSize), PDO::PARAM_INT);
		$sth->bindValue(':fk_orden_compra',$fk_orden_compra, PDO::PARAM_INT);
		$sth->bindValue(':idalmacen',$idalmacen, PDO::PARAM_INT);
		
		
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