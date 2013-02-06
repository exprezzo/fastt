<?php
class ArticuloStockModel extends Modelo{
	var $tabla='articulostock';
	var $pk='idarticuloalmacen';
	function guardar($params){
		$dbh=$this->getConexion();		
		
		$pk			=empty($params[ $this->pk ] )? 0 : $params[ $this->pk ];
		
		$sqlSets='';
		
		if ( isset($params['idarticulo']) ){			
			$idarticulo	=$params['idarticulo'];
			
			$sqlSets.= empty($sqlSets)? ' ' : ', ';
			$sqlSets.=' idarticulo=:idarticulo';
		}
		
		if ( isset($params['idalmacen']) ){
			$idalmacen	=$params['idalmacen'];
			
			$sqlSets.= empty($sqlSets)? ' ' : ', ';
			$sqlSets.=' idalmacen=:idalmacen';
		}
		
		if ( isset($params['existencia']) ){
			$existencia	=$params['existencia'];
			
			$sqlSets.= empty($sqlSets)? ' ' : ', ';
			$sqlSets.=' existencia=:existencia';
		}		
				
		if ( isset($params['minimo']) ){
			$minimo	=$params['minimo'];
			
			$sqlSets.= empty($sqlSets)? ' ' : ', ';
			$sqlSets.=' minimo=:minimo';
		}
		
		if ( isset($params['maximo']) ){
			$maximo	=$params['maximo'];
			
			$sqlSets.= empty($sqlSets)? ' ' : ', ';
			$sqlSets.=' maximo=:maximo';
		}
		
		if ( isset($params['puntoreorden']) ){
			$puntoreorden	=$params['puntoreorden'];
			
			$sqlSets.= empty($sqlSets)? ' ' : ', ';
			$sqlSets.=' puntoreorden=:puntoreorden';
		}
		
		if ( isset($params['idgrupo']) ){
			$idgrupo	=$params['idgrupo'];
			
			$sqlSets.= empty($sqlSets)? ' ' : ', ';
			$sqlSets.=' idgrupo=:idgrupo';
		}
		
		if ( isset($params['grupoposicion']) ){
			$grupoposicion	=$params['grupoposicion'];
			
			$sqlSets.= empty($sqlSets)? ' ' : ', ';
			$sqlSets.=' grupoposicion=:grupoposicion';
		}					
		
		
		if ( empty($pk) ){
			//           CREAR			
			$sql='INSERT INTO '.$this->tabla.' SET '.$sqlSets;									
			$sth = $dbh->prepare($sql);
			if ( isset($idarticulo) ) $sth->bindValue(":idarticulo", $idarticulo, PDO::PARAM_INT);
			if ( isset($idalmacen) ) $sth->bindValue(":idalmacen", $idalmacen,PDO::PARAM_INT);
			if ( isset($existencia) ) $sth->bindValue(":existencia", $existencia,PDO::PARAM_INT);
			if ( isset($minimo) ) $sth->bindValue(":minimo", $minimo,PDO::PARAM_INT);			
			if ( isset($maximo) ) $sth->bindValue(":maximo", $maximo,PDO::PARAM_INT);									
			if ( isset($puntoreorden) ) $sth->bindValue(":puntoreorden", $puntoreorden,PDO::PARAM_INT);			
			if ( isset($idgrupo) ) $sth->bindValue(":idgrupo", $idgrupo,PDO::PARAM_INT);						
			if ( isset($grupoposicion) ) $sth->bindValue(":grupoposicion", $grupoposicion,PDO::PARAM_INT);						
			$msg='registro Creado';							
		}else{
			//	         ACTUALIZAR
			$sql='UPDATE '.$this->tabla.' SET '.$sqlSets.' WHERE '.$this->pk.'=:pk';			
			$sth = $dbh->prepare($sql);										
			if ( isset($idarticulo) ) $sth->bindValue(":idarticulo", $idarticulo, PDO::PARAM_INT);
			if ( isset($idalmacen) ) $sth->bindValue(":idalmacen", $idalmacen,PDO::PARAM_INT);
			if ( isset($existencia) ) $sth->bindValue(":existencia", $existencia,PDO::PARAM_INT);
			if ( isset($minimo) ) $sth->bindValue(":minimo", $minimo,PDO::PARAM_INT);			
			if ( isset($maximo) ) $sth->bindValue(":maximo", $maximo,PDO::PARAM_INT);									
			if ( isset($puntoreorden) ) $sth->bindValue(":puntoreorden", $puntoreorden,PDO::PARAM_INT);			
			if ( isset($idgrupo) ) $sth->bindValue(":idgrupo", $idgrupo,PDO::PARAM_INT);						
			if ( isset($grupoposicion) ) $sth->bindValue(":grupoposicion", $grupoposicion,PDO::PARAM_INT);									
			
			$sth->bindValue(":pk", $pk,PDO::PARAM_INT);						
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
	
}
?>