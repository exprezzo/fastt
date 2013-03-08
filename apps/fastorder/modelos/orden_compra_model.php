<?php
include_once '../apps/'.$_PETICION->modulo.'/modelos/pedido_producto_model.php';
// include_once '../apps/'.$_PETICION->modulo.'/modelos/pedido_producto_tmp_model.php';
class OrdenCompraModel extends Modelo{
	var $tabla='orden_compra';	
	var $pk='id';
	
	function borrar( $params ){
		if ( empty($params['id']) ){
			throw new Exeption("Es necesario el parámetro 'id'");
		};		
		$id=$params['id'];
		$sql = 'DELETE FROM '.$this->tabla.' WHERE id=:id';		
		$con = $this->getConexion();
		$sth = $con->prepare($sql);		
		$sth->bindValue(':id',$id,PDO::PARAM_INT);		
		$exito = $sth->execute();					
		if ( !$exito ) return $this->getError($sth);
		
		$sql = 'DELETE FROM orden_compra_productos WHERE fk_orden_compra=:fk_orden_compra';		
		$con = $this->getConexion();
		$sth = $con->prepare($sql);		
		$sth->bindValue(':fk_orden_compra',$id,PDO::PARAM_INT);		
		$exito = $sth->execute();					
		if ( !$exito ) return $this->getError($sth);
		
		return $exito;	
	}
	function nuevo(){
		$params=array(
			'id'=>0
		);
		
		$params=array();
		$params['id']=0;
		$params['fk_almacen']=0;
		$params['nombreAlmacen']='';
		$params['fecha']=date('Y-m-d H:i:s');				
		$params['vencimiento']=date('Y-m-d H:i:s');				
		$params['id_tmp']=uniqid();
		$params['articulos']=array();
		return array(
			'success'=>true,
			'datos'=>$params
		);
	}
	
	function obtener($idPedido){
		
		$id=$idPedido;
				
		$sql = 'SELECT ped.*,se.serie ,alm.nombre as nombreAlmacen FROM '.$this->tabla.' ped
		LEFT JOIN almacenes alm ON alm.id = ped.fk_almacen
		LEFT JOIN orden_compra_series se ON se.id = ped.fk_serie
		WHERE ped.'.$this->pk.'=:id';		
		
		$con = $this->getConexion();
		$sth = $con->prepare($sql);		
		$sth->bindValue(':id',$id);		
		$sth->execute();
		$modelos = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		if ( empty($modelos) ){
			//throw new Exception(); //TODO: agregar numero de error, crear una exception MiEscepcion
			return array();
		}
		
		if ( sizeof($modelos) > 1 ){
			throw new Exception("El identificador está duplicado"); //TODO: agregar numero de error, crear una exception MiEscepcion
		}
		
		$articulos=array();
		// $articulos=$this->getArticulos( $id );
		 $modelos[0]['articulos']=$articulos;
		return $modelos[0];	
	}
	
	function paginar($params){
		
		$start=empty($params['start'])? 0 : intval($params['start']);
		$pageSize=empty($params['pageSize'])? 9 : intval($params['pageSize']);
		
		//echo $pageSize;
		$f1=empty($params['fechai'])? '' : $params['fechai'];
		$f2=empty($params['fechaf'])? '' : $params['fechaf'];
		
		
		$idproveedor=empty($params['idproveedor'])? 0 : $params['idproveedor'];
		$vencimiento=empty($params['vencimiento'])? '' : $params['vencimiento'];
		$idestado=empty($params['idestado'])? 0 : $params['idestado'];
		
		$sql='select COUNT(ped.id) as total FROM '.$this->tabla.' ped ';
				
		$filtros='';
		if ( !empty($f1) ){
			$filtros.=' WHERE fecha >= :f1 ';				
		}
		
		if ( !empty($f2) ){
			$filtros.=empty($filtros)? ' WHERE ': ' AND ';
			$filtros.='fecha <= :f2 ';
		}
					
		if ( !empty($vencimiento) ){
			$filtros.=empty($filtros)? ' WHERE ': ' AND ';					
			$filtros.='  vencimiento >= :vencimiento  ';
		}
		
		if ( !empty($idproveedor) ){
			$filtros.=empty($filtros)? ' WHERE ': ' AND ';
			$filtros.='idproveedor=:idproveedor ';
		}
		
		if ( !empty($idestado) ){
			$filtros.=empty($filtros)? ' WHERE ': ' AND ';
			$filtros.='idestado=:idestado ';
		}
		
		$sql.=$filtros;
	//	echo $sql;
		$model=$this;
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		
		if ( !empty($f1) ){						
			$sth->bindValue(":f1",$f1,PDO::PARAM_STR);
		}
		if ( !empty($f2) ){						
			$sth->bindValue(":f2",$f2,PDO::PARAM_STR);
		}		
		if ( !empty($vencimiento) ){			
			$sth->bindValue(":vencimiento",$vencimiento,PDO::PARAM_STR);
		}
		
		if ( !empty($idproveedor) ){			
			$sth->bindValue(":idproveedor",$idproveedor,PDO::PARAM_INT);			
		}
		if ( !empty($idestado) ){			
			$sth->bindValue(":idestado",$idestado,PDO::PARAM_INT);			
		}
		$datos=$model->execute($sth);			
		$total=$datos['datos'][0]['total'];
		
		$sql='select ped.*,CONCAT(sn.serie," ", folio ) as serie,st.nombre as estado, DATE_FORMAT(fecha,"%d/%m/%Y %H:%i:%s" ) as fecha,
			DATE_FORMAT(vencimiento,"%d/%m/%Y %H:%i:%s" ) as vencimiento, pro.nombre as nombreAlmacen 
			FROM '.$this->tabla.' ped
			LEFT JOIN proveedor pro ON pro.id = ped.idproveedor 
			LEFT JOIN orden_compra_series sn ON sn.id = ped.fk_serie 
			LEFT JOIN orden_compra_estado st ON st.id = ped.idestado 
			';
		
		$filtros='';
		if ( !empty($f1) ){
			$filtros.=' WHERE fecha >= :f1 ';				
		}
		
		if ( !empty($f2) ){
			$filtros.=empty($filtros)? ' WHERE ': ' AND ';
			$filtros.='fecha <= :f2 ';
		}
					
		if ( !empty($vencimiento) ){
			$filtros.=empty($filtros)? ' WHERE ': ' AND ';					
			$filtros.='  vencimiento >= :vencimiento  ';
		}		
		
		if ( !empty($idproveedor) ){
			$filtros.=empty($filtros)? 'WHERE ': ' AND ';
			$filtros.='idproveedor=:idproveedor';
		}
		
		if ( !empty($idestado) ){
			$filtros.=empty($filtros)? ' WHERE ': ' AND ';
			$filtros.='idestado=:idestado ';
		}
		
		$sql.=$filtros;
		
		$sql.=' ORDER BY ped.fecha DESC LIMIT :start,:limit';		
		
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$sth->bindValue(':start',$start, PDO::PARAM_INT);		
		$sth->bindValue(':limit',$pageSize, PDO::PARAM_INT);		
		
		if ( !empty($f1) ){
			$sth->bindValue(":f1",$f1,PDO::PARAM_STR);
		}
		if ( !empty($f2) ){
			$sth->bindValue(":f2",$f2,PDO::PARAM_STR);
		}		
		
		if ( !empty($vencimiento)  ){
			$sth->bindValue(":vencimiento",$vencimiento,PDO::PARAM_STR);
		}
		
		if ( !empty($idproveedor) ){
			$sth->bindValue(":idproveedor",$idproveedor,PDO::PARAM_INT);			
		}
		
		if ( !empty($idestado) ){
			$sth->bindValue(":idestado",$idestado,PDO::PARAM_INT);			
		}
		$exito=$sth->execute();
		if (!$exito){
			return $this->getError($sth);
		}
		$datos= $sth->fetchAll(PDO::FETCH_ASSOC);
		
		return array(
			'total'=>$total,
			'datos'=>$datos,
			'success'=>true
		);
	}
	
	
	function asignarFolio($idFolio){
		//      http://dev.mysql.com/doc/refman/5.0/es/innodb-locking-reads.html		
		try {
			$db=$this->getConexion();
			// $sql='START TRANSACTION;';
			// $db->exec($sql);			
			$db->beginTransaction();
			$tablaSeries='orden_compra_series';
			//Revisa que la serie tenga folios disponibles			
			$sql='SELECT folio_f, sig_folio FROM '.$tablaSeries.' where id='.intval($idFolio).'  FOR UPDATE;';			
			//Si no hay folios disponibles, devolver el error
			$result = $db->query($sql);
			if ( !$result ) return $this->getError($db);			
			$row = $result->fetch(PDO::FETCH_ASSOC);						
			if ( $row['folio_f'] < $row['sig_folio'] ) {
				$db->rollBack( );
				return array(
					'success'=>false,
					'msg'=>'Esta serie no tiene folios disponibles',
					'tipoError'=>'info'
				);
			}
			
			$sig_folio=$row['sig_folio'];			
			$sql= 'UPDATE '.$tablaSeries.' SET sig_folio = '.($sig_folio + 1).' WHERE id='.$idFolio.';';			
			$db->exec($sql);			
		}
		catch(PDOException $e)
		{
			$db->rollBack( );
			echo $e->getMessage();
			die();
		}		
		$msgType='';
		return array(
			'success'=>true,
			'folio'=>$sig_folio,
			'msg'=>'',
			'msgType'=>$msgType
		);
		/*			
		compararlo con el anterior y guardar bandera para notificar al usuario en caso de cambio,
		
		guardar,
		terminar transaccion,
		desbloquear tabla folios.			
		*/
	}
	
	function guardar($params){
		 // print_r($params);	
		$dbh=$this->getConexion();
		$pk			=empty($params[$this->pk]) ? 0 : $params[$this->pk];
		$fk_almacen	=$params['almacen'];
		$strFecha	=$params['fecha'];
		$vencimiento=$params['vencimiento'];
		$fk_serie 	=intval($params['fk_serie']);
		$folio 		=intval($params['folio']);
		$fk_proveedor	=intval($params['proveedor']);
		
		$msgType='';
		if ( empty($pk) ){
			$res = $this->asignarFolio( $fk_serie );
			if ( !$res['success'] ) return $res;
			$msg='Pedido Guardado';
			if ( intval($folio) != intval($res['folio']) ){
				$msgType='info';
				$msg.='<br>El sistema asign&oacute; el folio correspondiente. ('.$res['folio'].')';
			}
			$folio=$res['folio'];		
			//           CREAR
			$sql='INSERT INTO '.$this->tabla.' SET fk_almacen=:fk_almacen, idproveedor=:idproveedor, fecha= :fecha, vencimiento=:vencimiento, fk_serie=:fk_serie, folio=:folio';
			$sth = $dbh->prepare($sql);
			$sth->bindValue(":fk_almacen",$fk_almacen,PDO::PARAM_INT);
			$sth->bindValue(":idproveedor",$fk_proveedor,PDO::PARAM_INT);
			$sth->bindValue(":fecha",$strFecha,PDO::PARAM_STR);
			$sth->bindValue(":vencimiento",$vencimiento,PDO::PARAM_STR);
			$sth->bindValue(":fk_serie",$fk_serie,PDO::PARAM_INT);
			$sth->bindValue(":folio",$folio,PDO::PARAM_INT);
			
			
			// echo $sql;
			$exito = $sth->execute();
			//Terminar transaccion y desbloquear tabla
			
			if ($exito){
				$pk=$dbh->lastInsertId();
				$dbh->commit();
			}else{
				$dbh->rollBack();
			}
		}else{
			//	         ACTUALIZAR
			// $sql='UPDATE '.$this->tabla.' SET fk_almacen=:fk_almacen, fecha=:fecha, vencimiento=:vencimiento, fk_serie=:fk_serie,folio=:folio WHERE '.$this->pk.'=:pk';
			$mod = $this->obtener($pk);
			if (intval( intval($mod['idestado'])!==1) ){
				return array(
					'success'=>false,
					'msg'=>'El pedido no puede modificarse<br />Solo los pedidos con estado <b>Solicitado</b> pueden modificarse.'
				);
			}
			$sql='UPDATE '.$this->tabla.' SET fecha=:fecha, vencimiento=:vencimiento WHERE '.$this->pk.'=:pk';
			$sth = $dbh->prepare($sql);
			$sth->bindValue(":fecha",		$strFecha,		PDO::PARAM_STR);
			$sth->bindValue(":pk",			$pk,			PDO::PARAM_INT);
			$sth->bindValue(":vencimiento",	$vencimiento,	PDO::PARAM_STR);
			$msg='Pedido Actualizado';
			$exito = $sth->execute();
		}
		
		if (!$exito){
			return $this->getError($sth);
		}else{
			//$res=$this->procesarClones($pk,$params);
			$res=$this->guardarDetalles($pk,$params);			
			if (!$res['success']) return $res;
			$pedido=$this->obtener($pk);
		}
		
		//print_r($pedido);
		$msg.='<br/>Pedido Interno: '.$pedido['serie'].' '.$pedido['folio'];
		
		return array(
			'success'=>$exito,
			'msg'=>$msg,
			'msgType'=>$msgType,
			'datos'=>$pedido
		);
	}
	
	function guardarDetalles($fk_orden_compra, $params ){
		//Insertar, Actualizar y borrar.
		$con = $this->getConexion();
		
		$idproveedor = $params['proveedor'];
		
		foreach($params['articulos'] as $detalle){
			if ( !empty($detalle['id']) && !empty($detalle['eliminado']) ){
				$sql='DELETE FROM orden_compra_productos WHERE id=:id';
				$sth = $con->prepare($sql);
				$sth->bindValue(':id',		$detalle['id'],		PDO::PARAM_INT);				
				$exito = $sth->execute();
				if (!$exito) return $this->getError($sth);
			}else if ( empty($detalle['id']) ){
				
				$sql='INSERT INTO orden_compra_productos SET fk_producto_origen=:fk_producto_origen, fk_almacen=:fk_almacen,pedidoi=:pedidoi, fk_articulo=:fk_articulo, fk_orden_compra=:fk_orden_compra,fk_pedido_detalle=:fk_pedido_detalle, cantidad=:cantidad, idarticulopre=:idarticulopre';
				$sth = $con->prepare($sql);
				$sth->bindValue(':fk_orden_compra',		$fk_orden_compra,		PDO::PARAM_INT);
				$sth->bindValue(':fk_pedido_detalle', empty($detalle['fk_pedido_detalle'])? 0: $detalle['fk_pedido_detalle'],PDO::PARAM_INT);				
				$sth->bindValue(':fk_almacen', empty($detalle['fk_almacen'])? 0: $detalle['fk_almacen'] , PDO::PARAM_INT);				
				
				$sth->bindValue(':fk_producto_origen', empty($detalle['fk_producto_origen'])? 0: $detalle['fk_producto_origen'], PDO::PARAM_INT);				
				
				$sth->bindValue(':fk_articulo',		$detalle['fk_articulo'],	PDO::PARAM_INT);
				$sth->bindValue(':cantidad',		$detalle['pedido'],		PDO::PARAM_INT);
				$sth->bindValue(':pedidoi',		empty($detalle['pedidoi'])? 0: $detalle['pedidoi'],		PDO::PARAM_INT);
				$sth->bindValue(':idarticulopre',	$detalle['idarticulopre'],	PDO::PARAM_INT);
				$exito = $sth->execute();
				if (!$exito) return $this->getError($sth);
			}else{
				$sql='UPDATE orden_compra_productos SET fk_articulo=:fk_articulo, cantidad=:cantidad, idarticulopre=:idarticulopre WHERE id=:id';
				$sth = $con->prepare($sql);
				$sth->bindValue(':id',		$detalle['id'],		PDO::PARAM_INT);
				$sth->bindValue(':fk_articulo',		$detalle['fk_articulo'],	PDO::PARAM_INT);
				$sth->bindValue(':cantidad',		$detalle['pedido'],		PDO::PARAM_INT);
				$sth->bindValue(':idarticulopre',	$detalle['idarticulopre'],	PDO::PARAM_INT);
				$exito = $sth->execute();
				if (!$exito) return $this->getError($sth);
			}			
			
			if (isset($detalle['existencia']) ){
				$sql='UPDATE articulostock SET existencia=:existencia WHERE idarticulo=:idarticulo AND idalmacen=:idalmacen';
				 $sth = $con->prepare($sql);
				 
				 $sth->bindValue(':existencia',$detalle['existencia'],PDO::PARAM_INT);
				 $sth->bindValue(':idarticulo',$detalle['fk_articulo'],PDO::PARAM_INT);
				 $sth->bindValue(':idalmacen',empty($params['almacen'])? 0: $params['almacen'],PDO::PARAM_INT);
				 $exito = $sth->execute();
				 
				 
				 if (!$exito) {
					$error=$this->getError($sth);
					print_r($error);
					return $error;
				 }
			}
			 
		}		
		$resp=array('success'=>true);
		
		return $resp;
		
	}
	function cerrar($fk_tmp){
		//BORRAR TODO
		$con = $this->getConexion();
		$sql='DELETE FROM tmp_pedidos_productos WHERE fk_tmp=:fk_tmp';
		$sth = $con->prepare($sql);							
		$sth->bindValue(':fk_tmp',$fk_tmp,PDO::PARAM_STR);			
		$exito = $sth->execute();			
		$msg='ok';
		if (!$exito){
			$resp['success']=false;
			$error=$sth->errorInfo();
			$msg  = $error[2];					
			$resp['success']=false;
			$resp['msg']=$msg;
			return $resp;
		}
		
		//borrar
		return array(
			'success'=>$exito,
			'msg'=>$msg
		);
	}
	
}
?>