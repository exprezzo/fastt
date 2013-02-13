<?php

class PedidoProductoTmpModel extends Modelo{
	var $tabla='tmp_pedidos_productos';	
	var $pk='id_tmp';
	
	function guardar($params){
		$dbh=$this->getConexion();		
		
		$pk			=empty($params[ $this->pk ] )? 0 : $params[ $this->pk ];
				
		$id	=$params['id'];
		$fk_pedido	=$params['fk_pedido'];
		$fk_tmp	=$params['fk_tmp'];
		$fk_articulo	=$params['fk_articulo'];
		$idarticulopre	=$params['idarticulopre'];
		$cantidad	=$params['pedido'];
		
		$maximo=$params['maximo'];
		$minimo=$params['minimo'];
		$puntoreorden=$params['puntoreorden'];
		$existencia=$params['existencia'];
		
		if ( empty($pk) ){
			//           CREAR			
			$sql='INSERT INTO '.$this->tabla.' SET fk_articulo=:fk_articulo, idarticulopre= :idarticulopre, cantidad=:cantidad, fk_pedido=:fk_pedido, id=:id,fk_tmp=:fk_tmp
			,maximo=:maximo, minimo=:minimo, puntoreorden=:puntoreorden,existencia=:existencia';									
			$sth = $dbh->prepare($sql);
			$sth->bindValue(":fk_articulo", $fk_articulo, PDO::PARAM_INT);
			$sth->bindValue(":idarticulopre", $idarticulopre,PDO::PARAM_INT);
			$sth->bindValue(":cantidad", $cantidad,PDO::PARAM_INT);
			$sth->bindValue(":fk_pedido", $fk_pedido,PDO::PARAM_INT);			
			$sth->bindValue(":fk_tmp", $fk_tmp,PDO::PARAM_STR);						
			$sth->bindValue(":id", $id, PDO::PARAM_INT);			
			$sth->bindValue(":maximo", $maximo,PDO::PARAM_INT);			
			$sth->bindValue(":minimo", $minimo,PDO::PARAM_INT);			
			$sth->bindValue(":puntoreorden", $puntoreorden,PDO::PARAM_INT);			
			$sth->bindValue(":existencia", $existencia,PDO::PARAM_INT);						
			$msg='registro Creado';							
		}else{
			//	         ACTUALIZAR
			$sql='UPDATE '.$this->tabla.' SET fk_articulo=:fk_articulo, idarticulopre= :idarticulopre, cantidad=:cantidad,fk_tmp=:fk_tmp
			,maximo=:maximo, minimo=:minimo, puntoreorden=:puntoreorden,existencia=:existencia 
			WHERE '.$this->pk.'=:pk';			
			$sth = $dbh->prepare($sql);										
			$sth->bindValue(":fk_articulo", $fk_articulo, PDO::PARAM_INT);
			$sth->bindValue(":idarticulopre", $idarticulopre,PDO::PARAM_INT);			
			$sth->bindValue(":cantidad", $cantidad,PDO::PARAM_INT);
			$sth->bindValue(":pk",$pk,PDO::PARAM_INT);
			$sth->bindValue(":fk_tmp", $fk_tmp,PDO::PARAM_STR);						
			$sth->bindValue(":maximo", $maximo,PDO::PARAM_INT);			
			$sth->bindValue(":minimo", $minimo,PDO::PARAM_INT);			
			$sth->bindValue(":puntoreorden", $puntoreorden,PDO::PARAM_INT);			
			$sth->bindValue(":existencia", $existencia,PDO::PARAM_INT);
			$msg='registro Actualizado';		
		}		
		$exito = $sth->execute();
		
		if (!$exito){
			$resp['success']=false;
			$error=$sth->errorInfo();
			$msg    = $error[2];
			$elemeno=$params;
		}else{
			if ( empty($pk) ) $pk=$dbh->lastInsertId();			
			$elemeno=$this->obtener( array($this->pk=> $pk) );			
		}
		
		return array(
			'success'=>$exito,
			'msg'=>$msg,
			'datos'=>$elemeno
		);		
		
		return $res;
	}
	
	
	
	function paginar($params){
		
		$start=$params['start'];
		$pageSize=$params['limit'];
		$fk_tmp=$params['fk_tmp'];
		$idalmacen=empty($params['idalmacen'])? 0 :intval( $params['idalmacen']);
		
		$sql='select COUNT(pedprod.id) as total FROM '.$this->tabla.' pedprod		
		WHERE pedprod.fk_tmp=:fk_tmp';		
		
		$model=$this;
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$sth->bindValue(':fk_tmp',$fk_tmp, PDO::PARAM_INT);
		$datos=$model->execute($sth);
		
		if (!$datos['success']) return $datos;
		
		$total=$datos['datos'][0]['total'];
		//, maximo maximo, minimo, reorden, iinicial, sugerido, pedido, pendiente,fk_articulo, id_tmp, fk_um,id id
		$sql = 'SELECT pedprod.*,prod.nombre as nombre,pre.descripcion as presentacion,pre.idarticulopre, prod.codigo codigo, 
		sto.maximo, sto.minimo, sto.puntoreorden, pedprod.existencia,cantidad pedido ,sto.maximo - sto.existencia sugerido,((sto.puntoreorden - sto.existencia)- cantidad) pendiente,
		sto.idgrupo, sto.grupoposicion, gpo.nombre nombreGpo
		FROM '.$this->tabla.' pedprod
		LEFT JOIN productos prod ON pedprod.fk_articulo = prod.id
		LEFT JOIN articulopre pre ON pedprod.idarticulopre =pre.idarticulopre
		LEFT JOIN articulostock sto ON sto.idarticulo= pedprod.fk_articulo AND sto.idalmacen=:idalmacen
		LEFT JOIN grupo_de_productos gpo ON  gpo.id=sto.idgrupo
		WHERE pedprod.fk_tmp=:fk_tmp ORDER BY sto.grupoposicion, gpo.id limit :start,:limit';		
				
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		 $sth->bindValue(':start',intval($start), PDO::PARAM_INT);
		 $sth->bindValue(':limit',intval($pageSize), PDO::PARAM_INT);
		$sth->bindValue(':fk_tmp',$fk_tmp, PDO::PARAM_INT);
		$sth->bindValue(':idalmacen',$idalmacen, PDO::PARAM_INT);
		
		
		$datos=$model->execute($sth);
		
		if (!$datos['success']) return $datos;
		
		return array(			
			'totalRows'=>$total,
			'rows'=>$datos['datos']
		);
	}
	
}
?>