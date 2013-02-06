<?php
include '../apps/'.$_PETICION->modulo.'/modelos/pedido_producto_model.php';
include_once '../apps/'.$_PETICION->modulo.'/modelos/pedido_producto_tmp_model.php';
class PedidoModel extends Modelo{
	var $tabla='pedidos';	
	var $pk='id';
		
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
	
	function editar($idPedido){
		$mod=$this->obtener($idPedido);		
		$id_tmp=uniqid();
		$mod['id_tmp']=$id_tmp;
		
		$res=$this->clonar($idPedido, $id_tmp, $mod['fk_almacen']);
		if (!$res['success']){
			print_r($res); exit;
		}
		return $mod;
	}
	
	function clonar($fk_pedido, $fk_tmp,$idalmacen){
		$sql='INSERT INTO tmp_pedidos_productos (id, fk_articulo, fk_pedido,cantidad, idarticulopre, fk_tmp,maximo,minimo,existencia,puntoreorden)
		SELECT id,fk_articulo, fk_pedido,cantidad, idarticulopre,:fk_tmp  fk_tmp, maximo, minimo, existencia,puntoreorden
		from pedidos_productos prods
		LEFT JOIN articulostock  sto ON sto.idarticulo = prods.fk_articulo AND sto.idalmacen = :idalmacen
		WHERE fk_pedido=:fk_pedido';
		
		$con = $this->getConexion();
		$sth = $con->prepare($sql);		
		$sth->bindValue(':fk_pedido',$fk_pedido);		
		$sth->bindValue(':fk_tmp',$fk_tmp);	
		$sth->bindValue(':idalmacen',$idalmacen);	
		
		$exito = $sth->execute();
		
		$msg='ok';
		if (!$exito){			
			$resp['success']=false;
			$error=$sth->errorInfo();
			$msg    = $error[2];
			$elemeno=$params;
		}
		
		return array(
			'success'=>$exito,
			'msg'=>$msg
		);						
	}
	function obtener($idPedido){
		
		$id=$idPedido;
				
		$sql = 'SELECT ped.*,alm.nombre as nombreAlmacen FROM '.$this->tabla.' ped
		LEFT JOIN almacenes alm ON alm.id = ped.fk_almacen
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
		
		$idalmacen=empty($params['idalmacen'])? 0 : $params['idalmacen'];
		$vencimiento=empty($params['vencimiento'])? '' : $params['vencimiento'];
		$idestado=empty($params['idestado'])? 0 : $params['idestado'];
		
		$sql='select COUNT(ped.id) as total FROM pedidos ped ';
		
		$filtros='';
		if ( !empty($f1)&& !empty($f2) ){
			$filtros='WHERE (fecha between :f1 and :f2) ';
		}else{			
		    if ( !empty($f1) ){
				$filtros.=' WHERE fecha >= :f1 ';				
			}
			
			if ( !empty($f2) ){
				$filtros.=' WHERE fecha <= :f2 ';
			}
		}
			
		if ( !empty($vencimiento) && !empty($f2) ){
			$filtros.=empty($filtros)? ' WHERE ': ' AND ';					
			$filtros.=' (vencimiento between :vencimiento and :f2) ';						
		}else if ( !empty($vencimiento) && !empty($f1) ){
			$filtros.=empty($filtros)? ' WHERE ': ' AND ';					
			$filtros.=' (vencimiento between :f1 and :vencimiento) ';						
		}
		
		if ( !empty($idalmacen) ){
			$filtros.=empty($filtros)? ' WHERE ': ' AND ';
			$filtros.='fk_almacen=:idalmacen ';
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
			//echo 'f1';
			$sth->bindValue(":f1",$f1,PDO::PARAM_STR);
		}
		if ( !empty($f2) ){			
			//echo 'F2';
			$sth->bindValue(":f2",$f2,PDO::PARAM_STR);
		}		
		if ( !empty($vencimiento) && ( !empty($f2) || !empty($f1) ) ){			
			//echo 'FV';
			$sth->bindValue(":vencimiento",$vencimiento,PDO::PARAM_STR);
		}
		
		if ( !empty($idalmacen) ){			
			$sth->bindValue(":idalmacen",$idalmacen,PDO::PARAM_INT);			
		}
		if ( !empty($idestado) ){			
			$sth->bindValue(":idestado",$idestado,PDO::PARAM_INT);			
		}
		$datos=$model->execute($sth);		
	//	print_r($datos	);
		$total=$datos['datos'][0]['total'];
		
		$sql='select ped.*,CONCAT(sn.serie," ", folio ) as serie,st.nombre as estado, DATE_FORMAT(fecha,"%d/%m/%Y %H:%i:%s" ) as fecha,DATE_FORMAT(vencimiento,"%d/%m/%Y %H:%i:%s" ) as vencimiento, alm.nombre as nombreAlmacen FROM pedidos ped
			LEFT JOIN almacenes alm ON alm.id = ped.fk_almacen 
			LEFT JOIN series sn ON sn.id = ped.fk_serie 
			LEFT JOIN estado_pedido st ON st.id = ped.idestado 
			';
		
		$filtros='';
		if ( !empty($f1)&& !empty($f2) ){
			$filtros='WHERE fecha between :f1 and :f2';
		}else{
			if ( !empty($f1) ){
				$filtros.=' WHERE fecha >= :f1 ';				
			}
			
			if ( !empty($f2) ){
				$filtros.=' WHERE fecha <= :f2 ';				
			}
		}
		
		if ( !empty($vencimiento) && !empty($f2) ){
			$filtros.=empty($filtros)? 'WHERE ': ' AND ';		
			$filtros.='(vencimiento between :vencimiento and :f2)';
		}else if ( !empty($vencimiento) && !empty($f1) ){
			$filtros.=empty($filtros)? ' WHERE ': ' AND ';					
			$filtros.='(vencimiento between :f1 and :vencimiento)';						
		}
		
		if ( !empty($idalmacen) ){
			$filtros.=empty($filtros)? 'WHERE ': ' AND ';
			$filtros.='fk_almacen=:idalmacen';
		}
		
		if ( !empty($idestado) ){
			$filtros.=empty($filtros)? ' WHERE ': ' AND ';
			$filtros.='idestado=:idestado ';
		}
		
		$sql.=$filtros;
		// if ( !empty($vencimiento) ){
			// $sql='select ped.*,DATE_FORMAT(fecha,"%d/%m/%Y %H:%i:%s" ) as fecha,DATE_FORMAT(vencimiento,"%d/%m/%Y %H:%i:%s" ) as vencimiento, alm.nombre as nombreAlmacen FROM pedidos ped
			// LEFT JOIN almacenes alm ON alm.id = ped.fk_almacen 
			// WHERE (fecha between :f1 and :f2) AND (vencimiento between :vencimiento and :f2)';
		// }else{
			// $sql='select ped.*,DATE_FORMAT(fecha,"%d/%m/%Y %H:%i:%s" ) as fecha,DATE_FORMAT(vencimiento,"%d/%m/%Y %H:%i:%s" ) as vencimiento, alm.nombre as nombreAlmacen FROM pedidos ped
			// LEFT JOIN almacenes alm ON alm.id = ped.fk_almacen 
			// WHERE (fecha between :f1 and :f2)';
		// }
		
		// if ( !empty($idalmacen) ){
			// $sql.=' AND fk_almacen=:idalmacen';
		// }
		
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
		
		if ( !empty($vencimiento) && ( !empty($f2) || !empty($f1) ) ){
			$sth->bindValue(":vencimiento",$vencimiento,PDO::PARAM_STR);
		}
		
		if ( !empty($idalmacen) ){
			$sth->bindValue(":idalmacen",$idalmacen,PDO::PARAM_INT);			
		}
		
		if ( !empty($idestado) ){
			$sth->bindValue(":idestado",$idestado,PDO::PARAM_INT);			
		}
		$datos=$model->execute($sth);
		
		return array(
			'total'=>$total,
			'datos'=>$datos['datos']
		);
	}
	
	function getError($sth){
		$resp=array();
		$error=$sth->errorInfo();
		
		$resp['success']=false;			
		$resp['msg']=$error[2];
		return $resp;
	}
	function asignarFolio($idFolio){		
		//      http://dev.mysql.com/doc/refman/5.0/es/innodb-locking-reads.html		
		try {
			$db=$this->getConexion();
			// $sql='START TRANSACTION;';
			// $db->exec($sql);			
			$db->beginTransaction();
			
			//Revisa que la serie tenga folios disponibles			
			$sql='SELECT folio_f, sig_folio FROM series where id='.intval($idFolio).'  FOR UPDATE;';			
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
			$sql= 'UPDATE series SET sig_folio = '.($sig_folio + 1).' WHERE id='.$idFolio.';';			
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
		$dbh=$this->getConexion();
		$pk			=empty($params[$this->pk]) ? 0 : $params[$this->pk];
		$fk_almacen	=$params['almacen'];
		$strFecha	=$params['fecha'];
		$vencimiento=$params['vencimiento'];
		$fk_serie 	=intval($params['fk_serie']);
		$folio 	=intval($params['folio']);
		
		$msgType='';
		if ( empty($pk) ){			
			$res = $this->asignarFolio($fk_serie);
			if ( !$res['success'] ) return $res;
			$msg='Pedido Guardado';
			if ( intval($folio) != intval($res['folio']) ){
				$msgType='info';
				$msg.='<br>El sistema asign&oacute; el folio correspondiente. ('.$res['folio'].')';
			}
			$folio=$res['folio'];
		//	print_r($res);
			//           CREAR
			$sql='INSERT INTO '.$this->tabla.' SET fk_almacen=:fk_almacen , fecha= :fecha, vencimiento=:vencimiento, fk_serie=:fk_serie, folio=:folio';
			$sth = $dbh->prepare($sql);
			$sth->bindValue(":fk_almacen",$fk_almacen,PDO::PARAM_INT);
			$sth->bindValue(":fecha",$strFecha,PDO::PARAM_STR);
			$sth->bindValue(":vencimiento",$vencimiento,PDO::PARAM_STR);
			$sth->bindValue(":fk_serie",$fk_serie,PDO::PARAM_INT);
			$sth->bindValue(":folio",$folio,PDO::PARAM_INT);
			
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
			$sql='UPDATE '.$this->tabla.' SET fecha=:fecha, vencimiento=:vencimiento WHERE '.$this->pk.'=:pk';
			$sth = $dbh->prepare($sql);
			//$sth->bindValue(":fk_almacen",$fk_almacen,PDO::PARAM_INT);
			$sth->bindValue(":fecha",$strFecha,PDO::PARAM_STR);
			$sth->bindValue(":pk",$pk,PDO::PARAM_INT);
			$sth->bindValue(":vencimiento",$vencimiento,PDO::PARAM_STR);
			//$sth->bindValue(":fk_serie",$fk_serie,PDO::PARAM_INT);
			//$sth->bindValue(":folio",$folio,PDO::PARAM_INT);
			$msg='Pedido Actualizado';
			$exito = $sth->execute();
		}
		
		
		
		if (!$exito){
			$resp['success']=false;
			$error=$sth->errorInfo();
			$msg    = $error[2];
			$pedido=$params;
		}else{
			
			$res=$this->procesarClones($pk,$params);
			if (!$res['success']) return $res;
			$pedido=$this->obtener($pk);
		}
		
		return array(
			'success'=>$exito,
			'msg'=>$msg,
			'msgType'=>$msgType,
			'datos'=>$pedido
		);
		
	}
	
	function procesarClones($fk_pedido, $params){
		$resp=array();
		$fk_tmp=$params['IdTmp'];			
		
		$sql='INSERT INTO pedidos_productos (fk_articulo, fk_pedido, cantidad, idarticulopre)
		SELECT fk_articulo,:fk_pedido fk_pedido, cantidad, idarticulopre from tmp_pedidos_productos WHERE fk_tmp=:fk_tmp AND id=0';
		
		$con = $this->getConexion();
		$sth = $con->prepare($sql);
		$sth->bindValue(':fk_pedido',$fk_pedido,PDO::PARAM_INT);
		$sth->bindValue(':fk_tmp',$fk_tmp,PDO::PARAM_STR);
		$exito = $sth->execute();
		
		$msg='ok';
		if (!$exito){
			$resp['success']=false;
			$error=$sth->errorInfo();
			$msg    = $error[2];
			$elemeno=$params;			
		}
		
		//actualizar			
		$sql='SELECT id, fk_articulo, cantidad, idarticulopre from tmp_pedidos_productos WHERE fk_tmp=:fk_tmp AND id!=0 AND fk_pedido=:fk_pedido';			
		// $sql='INSERT INTO pedidos_productos (fk_articulo, fk_pedido, cantidad, idarticulopre)
		// SELECT fk_articulo,:fk_pedido fk_pedido, cantidad, idarticulopre from tmp_pedidos_productos WHERE fk_tmp=:fk_tmp AND id=0';			
		$con = $this->getConexion();
		$sth = $con->prepare($sql);
		$sth->bindValue(':fk_pedido',$fk_pedido,PDO::PARAM_INT);
		$sth->bindValue(':fk_tmp',$fk_tmp,PDO::PARAM_STR);
		$res = $this->execute($sth);											
		if (!$res['success'])return $res;
		foreach($res['datos'] as $elemento){				
			$fk_articulo=$elemento['fk_articulo'];
			$cantidad=$elemento['cantidad'];
			$id=$elemento['id'];
			$idarticulopre=$elemento['idarticulopre'];
			$sql='UPDATE pedidos_productos SET fk_articulo=:fk_articulo, cantidad=:cantidad, idarticulopre=:idarticulopre WHERE id=:id';
			$sth = $con->prepare($sql);				
			$sth->bindValue(':fk_articulo',$fk_articulo,PDO::PARAM_INT);
			$sth->bindValue(':cantidad',$cantidad,PDO::PARAM_INT);
			$sth->bindValue(':idarticulopre',$idarticulopre,PDO::PARAM_INT);
			
			$sth->bindValue(':id',intval($id),PDO::PARAM_INT);
			$exito = $sth->execute();			
			if (!$exito){
				$resp['success']=false;
				$error=$sth->errorInfo();
				$msg    = $error[2];					
				$resp['success']=false;
				$resp['msg']=$msg;
				return $resp;
			}
			
		}
		
		//BORRAR TODO
		$sql='DELETE FROM tmp_pedidos_productos WHERE fk_tmp=:fk_tmp';
		$sth = $con->prepare($sql);							
		$sth->bindValue(':fk_tmp',$fk_tmp,PDO::PARAM_STR);			
		$exito = $sth->execute();			
		if (!$exito){
			$resp['success']=false;
			$error=$sth->errorInfo();
			$msg    = $error[2];					
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