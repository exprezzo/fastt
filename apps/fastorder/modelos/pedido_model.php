<?php
include '../apps/'.$_PETICION->modulo.'/modelos/pedido_producto_model.php';
// include_once '../apps/'.$_PETICION->modulo.'/modelos/pedido_producto_tmp_model.php';
class PedidoModel extends Modelo{
	var $tabla='pedidos';
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
		
		$sql = 'DELETE FROM pedidos_productos WHERE fk_pedido=:fk_pedido';		
		$con = $this->getConexion();
		$sth = $con->prepare($sql);		
		$sth->bindValue(':fk_pedido',$id,PDO::PARAM_INT);		
		$exito = $sth->execute();					
		if ( !$exito ) return $this->getError($sth);
		
		return $exito;	
	}
	
	function concentrar(){
		/*		
		Concentración: Generacion automatica de ordenes de compra a partir de pedidos internos.
		Consideraciones:
			Cada proveedor tiene una lista de los productos que ofrece.
			Un producto puede ser manejado por mas de un proveedor.
			para saber a quien comprar, se genera un rankeo, para cada producto con todos los proveedores de ese producto.
			
		//De cada pedido interno, leer cada detalle que no haya sido concentrado por completo.
		//acumula las cantidades faltantes por producto
		//cuando el producto no tiene proveedores rankeados, se genera todo en una orden sin proveedor.
		//cuando el producto tiene ranking, selecciona al proveedor con el mas  alto.		
		
		Recetas: 
		
		*/
		
		//De cada pedido interno, leer cada detalle que no haya sido concentrado por completo.
		//(Ordenados por proveedor)
		// $sql='SELECT fk_articulo, idarticulopre, sum(cantidad) pedido
		// from 
		// pedidos_productos  p
		// LEFT JOIN productos pro ON pro.id=p.fk_articulo
		// WHERE status=1 AND cantidad > 0 AND tipo=1 GROUP BY fk_articulo';
				
		$con=$this->getConexion();
		
		//en esta consulta tengo la lista de articulos y el proveedor con mas prioridad
		$sql='SELECT fk_proveedor,fk_producto fk_articulo FROM (
			SELECT fk_producto, fk_proveedor FROM proveedor_producto  ORDER BY prioridad ASC) ordenados GROUP BY fk_producto';
		$sth=$con->prepare( $sql );
		$exito=$sth->execute();
		if ( !$exito ) return $this->getError( $sth );
		$prioridades=$sth->fetchAll( PDO::FETCH_ASSOC );
		
		//Ahora obtengo todos los detalles 
		$sql='SELECT pe.fk_almacen, pp.cantidad pedidoi , pp.fk_pedido, pp.id as fk_pedido_detalle,pp.fk_articulo as fk_producto_origen, pp.fk_articulo, 
		sto.maximo- (sto.existencia - pp.cantidad) as pedido,
		pp.idarticulopre 
		FROM 
		pedidos_productos pp
		left join pedidos pe ON pe.id = pp.fk_pedido
		LEFT JOIN productos p ON p.id=pp.fk_articulo
		left join articulostock sto ON sto.idalmacen = 3 AND sto.idarticulo = pp.fk_articulo
		WHERE pp.status=1 AND pp.cantidad>0 and p.tipo=1';
		
		$sth=$con->prepare($sql);
		$exito=$sth->execute();
		if ( !$exito ) return $this->getError( $sth );
		$detalles=$sth->fetchAll( PDO::FETCH_ASSOC );
		
		//ahora las recetas
		$sql='SELECT pe.fk_almacen, pp.id as fk_pedido_detalle, pp.fk_articulo as fk_producto_origen, ad.fk_articulo ,pp.idarticulopre	,
		sto.maximo- ( sto.existencia - (pp.cantidad * ad.cantidad) ) as pedido, (pp.cantidad * ad.cantidad) as pedidoi
		FROM 
		pedidos_productos pp
		left join pedidos pe ON pe.id = pp.fk_pedido
		LEFT JOIN productos p ON p.id=pp.fk_articulo
		LEFT JOIN articulo_detalle ad ON ad.idarticulo = pp.fk_articulo
		left join articulostock sto ON sto.idalmacen = 3 AND sto.idarticulo = pp.fk_articulo
		WHERE pp.status=1 AND pp.cantidad>0 and p.tipo=2';
		
		$sth=$con->prepare($sql);
		$exito=$sth->execute();
		if ( !$exito ) return $this->getError( $sth );
		$detallesRecetas=$sth->fetchAll( PDO::FETCH_ASSOC );
		$detalles = array_merge( $detalles, $detallesRecetas);
		
		$numDetalles =sizeof($detalles) ;
		if ($numDetalles==0) return array( 'success'=>true );		
		$ordenes=array();
		
		function getProovedor( $articulo,$prioridades ){
			
			for($i=0; $i<sizeof($prioridades); $i++ ){
				if ( $prioridades[$i]['fk_articulo'] == $articulo) return $prioridades[$i]['fk_proveedor'];
			}
			
			return 0;
		}
		for($i=0; $i< $numDetalles ;$i++ ){
			
			
			
			$proveedor = getProovedor( $detalles[$i]['fk_articulo'],$prioridades );
			
			
			if ( !isset($ordenes[$proveedor])   ) $ordenes[$proveedor]=array();
			//se acumulan los detalles al proveedor
			$ordenes[$proveedor][] =  $detalles[$i];
		}
				
		$ordenMod=new OrdenCompraModel();
		foreach($ordenes as $key=>$value){
			$orden=array(
				'almacen'		=>3,
				'fecha'			=>date('Y-m-d H:i:s'),
				'vencimiento'	=>date('Y-m-d H:i:s'),
				'folio'			=>1,
				'fk_serie'		=>4,
				'proveedor'		=>$key
			);
			$orden['articulos']=$value;
			$res=$ordenMod->guardar( $orden );
			if ( !$res['success'] ) return $res;
			
			foreach($orden['articulos'] as $item){
				$sql='UPDATE pedidos_productos SET status=2, concentrado=cantidad WHERE id='.$item['fk_pedido_detalle'].';';
				$sth=$con->prepare($sql);
				$exito=$sth->execute();
				if ( !$exito ) return $this->getError( $sth );
			}
		}
		
		//
		$sql='UPDATE pedidos SET idestado=2;';
		$sth=$con->prepare( $sql );
		$exito=$sth->execute( );
		if ( !$exito ) return $this->getError( $sth );
				
		
		
		return array(
			'success'=>true
		);
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
	
	function precargar($fk_tmp,$fk_pedido, $idalmacen){		
		$sql='SELECT 0 as id,stk.idarticulo as fk_articulo,:fk_pedido as fk_pedido, existencia as cantidad, pre.idarticulopre as idarticulopre,
		:fk_tmp  fk_tmp, stk.maximo, stk.minimo, stk.existencia,stk.puntoreorden,stk.idgrupo , stk.grupoposicion ,gpo.nombre nombreGpo,
		p.nombre,p.codigo,pre.descripcion presentacion,0 sugerido,0 pedido, 0 pendiente
		FROM articulostock  stk
		LEFT JOIN productos p ON p.id = stk.idarticulo
		LEFT JOIN articulopre pre ON pre.idarticulo = stk.idarticulo AND pre.default=1
		LEFT JOIN grupo_de_productos gpo ON  gpo.id=stk.idgrupo
		WHERE idalmacen=:idalmacen ORDER BY stk.idgrupo';
		$con=$this->getPdo();
		$sth = $con->prepare($sql);
		$sth->bindValue(':fk_tmp',$fk_tmp);				
		$sth->bindValue(':idalmacen',$idalmacen);				
		$sth->bindValue(':fk_pedido',$fk_pedido);				
		$exito = $sth->execute();				
		if (!$exito) return $this->getError($sth);
		$datos = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		
		return array(
			'success'=>true,
			'articulos'=>$datos
		
		);
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
				
		$sql = 'SELECT ped.*,se.serie ,alm.nombre as nombreAlmacen FROM '.$this->tabla.' ped
		LEFT JOIN almacenes alm ON alm.id = ped.fk_almacen
		LEFT JOIN series se ON se.id = ped.fk_serie
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
			$sth->bindValue(":f1",$f1,PDO::PARAM_STR);
		}
		if ( !empty($f2) ){						
			$sth->bindValue(":f2",$f2,PDO::PARAM_STR);
		}		
		if ( !empty($vencimiento) ){			
			$sth->bindValue(":vencimiento",$vencimiento,PDO::PARAM_STR);
		}
		
		if ( !empty($idalmacen) ){			
			$sth->bindValue(":idalmacen",$idalmacen,PDO::PARAM_INT);			
		}
		if ( !empty($idestado) ){			
			$sth->bindValue(":idestado",$idestado,PDO::PARAM_INT);			
		}
		$datos=$model->execute($sth);			
		$total=$datos['datos'][0]['total'];
		
		$sql='select ped.*,CONCAT(sn.serie," ", folio ) as serie,st.nombre as estado, DATE_FORMAT(fecha,"%d/%m/%Y %H:%i:%s" ) as fecha,DATE_FORMAT(vencimiento,"%d/%m/%Y %H:%i:%s" ) as vencimiento, alm.nombre as nombreAlmacen FROM pedidos ped
			LEFT JOIN almacenes alm ON alm.id = ped.fk_almacen 
			LEFT JOIN series sn ON sn.id = ped.fk_serie 
			LEFT JOIN estado_pedido st ON st.id = ped.idestado 
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
		
		if ( !empty($idalmacen) ){
			$filtros.=empty($filtros)? 'WHERE ': ' AND ';
			$filtros.='fk_almacen=:idalmacen';
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
		// print_r($params);
	
		$dbh=$this->getConexion();
		$pk			=empty($params[$this->pk]) ? 0 : $params[$this->pk];
		$fk_almacen	=$params['almacen'];
		$strFecha	=$params['fecha'];
		$vencimiento=$params['vencimiento'];
		$fk_serie 	=intval($params['fk_serie']);
		$folio 		=intval($params['folio']);
		
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
	
	function guardarDetalles($fk_pedido, $params){
		//Insertar, Actualizar y borrar.
		$con = $this->getConexion();
		
		$idalmacen = $params['almacen'];
		foreach($params['articulos'] as $detalle){
			if ( !empty($detalle['id']) && !empty($detalle['eliminado']) ){
				$sql='DELETE FROM pedidos_productos WHERE id=:id';
				$sth = $con->prepare($sql);
				$sth->bindValue(':id',		$detalle['id'],		PDO::PARAM_INT);				
				$exito = $sth->execute();
				if (!$exito) return $this->getError($sth);
			}else if ( empty($detalle['id']) ){
				$sql='INSERT INTO pedidos_productos SET fk_articulo=:fk_articulo, fk_pedido=:fk_pedido, cantidad=:cantidad, idarticulopre=:idarticulopre';
				$sth = $con->prepare($sql);
				$sth->bindValue(':fk_pedido',		$fk_pedido,		PDO::PARAM_INT);
				$sth->bindValue(':fk_articulo',		$detalle['fk_articulo'],	PDO::PARAM_INT);
				$sth->bindValue(':cantidad',		$detalle['pedido'],		PDO::PARAM_INT);
				$sth->bindValue(':idarticulopre',	$detalle['idarticulopre'],	PDO::PARAM_INT);
				$exito = $sth->execute();
				if (!$exito) return $this->getError($sth);
			}else{
				$sql='UPDATE pedidos_productos SET fk_articulo=:fk_articulo, cantidad=:cantidad, idarticulopre=:idarticulopre WHERE id=:id';
				$sth = $con->prepare($sql);
				$sth->bindValue(':id',		$detalle['id'],		PDO::PARAM_INT);
				$sth->bindValue(':fk_articulo',		$detalle['fk_articulo'],	PDO::PARAM_INT);
				$sth->bindValue(':cantidad',		$detalle['pedido'],		PDO::PARAM_INT);
				$sth->bindValue(':idarticulopre',	$detalle['idarticulopre'],	PDO::PARAM_INT);
				$exito = $sth->execute();
				if (!$exito) return $this->getError($sth);
			}			
			
			$sql='UPDATE articulostock SET existencia=:existencia WHERE idarticulo=:idarticulo AND idalmacen=:idalmacen';
			$sth = $con->prepare($sql);
			$sth->bindValue(':existencia',$detalle['existencia'],PDO::PARAM_INT);
			$sth->bindValue(':idarticulo',$detalle['fk_articulo'],PDO::PARAM_INT);
			$sth->bindValue(':idalmacen',$idalmacen,PDO::PARAM_INT);
			$exito = $sth->execute();
			if (!$exito) return $this->getError($sth);
		}		
		$resp=array('success'=>true);
		
		
		
		return $resp;
		
		$fk_tmp=$params['IdTmp'];
		
		$msg='ok';
		if (!$exito){
			$resp['success']=false;
			$error=$sth->errorInfo();
			$msg    = $error[2];
			$elemeno=$params;
		}
		
		//actualizar
		$sql='SELECT id, fk_articulo, cantidad, idarticulopre from tmp_pedidos_productos WHERE fk_tmp=:fk_tmp AND id!=0 AND fk_pedido=:fk_pedido';
		
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
		
		//Antes de borrar, actualizo los stocks		
		$idalmacen=$params['almacen'];
		$sql='SELECT existencia,fk_articulo FROM tmp_pedidos_productos WHERE fk_tmp=:fk_tmp';
		$sth = $con->prepare($sql);
		$sth->bindValue(':fk_tmp',$fk_tmp,PDO::PARAM_STR);
		$exito = $sth->execute();
		if (!$exito) return $this->getError($sth);
		
		$datos= $sth->fetchAll(PDO::FETCH_ASSOC);
		foreach($datos as $dato){
			$sql='UPDATE articulostock SET existencia=:existencia WHERE idarticulo=:idarticulo AND idalmacen=:idalmacen';
			$sth = $con->prepare($sql);
			$sth->bindValue(':existencia',$dato['existencia'],PDO::PARAM_INT);
			$sth->bindValue(':idarticulo',$dato['fk_articulo'],PDO::PARAM_INT);
			$sth->bindValue(':idalmacen',$idalmacen,PDO::PARAM_INT);
			$exito = $sth->execute();
			if (!$exito) return $this->getError($sth);
		}
		
		
		//BORRAR TODO
		$sql='DELETE FROM tmp_pedidos_productos WHERE fk_tmp=:fk_tmp';
		$sth = $con->prepare($sql);
		$sth->bindValue(':fk_tmp',$fk_tmp,PDO::PARAM_STR);
		$exito = $sth->execute();
		if (!$exito) return $this->getError($sth);
		
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