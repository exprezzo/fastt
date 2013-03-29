<?php
class ProductoModelo extends Modelo{
	var $tabla="productos";
	var $campos=array('id','nombre','codigo','tipo');
	
	function busquedaPersonal($params){
		// $start=0, $pageSize=9, $idalmacen=0, $codigo=''
		$idalmacen= isset($params['id_almacen']) ? $params['id_almacen'] : 0;
		$codigo= isset($params['codigo']) ? $params['codigo'] : '';				
		// $start= empty($params['pageSize']) ? null  : $params['start'];		
		$start= !empty($params['start']) ? $params['start']  : 0;
		$pageSize= isset($params['pageSize']) ? $params['pageSize'] : 100;
		
		$sql='select COUNT(id) as total FROM productos WHERE codigo like :codigo';
		$model=$this;
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$sth->bindValue(':codigo','%'.$codigo.'%', PDO::PARAM_STR);
		
		$exito=$sth->execute();
		if (!$exito) return $this->getError($sth);
		
		$datos =$sth->fetchAll(PDO::FETCH_ASSOC);
		
		
		$total=$datos[0]['total'];
		
		$sql='SELECT pro.id, pro.nombre,pro.codigo, gpo.nombre grupo,
		pre.idarticulopre, pre.descripcion presentacion,
		sto.existencia, minimo, maximo, puntoreorden,idgrupo, grupoposicion
		FROM productos pro 
		LEFT JOIN articulopre pre ON pre.idarticulo=pro.id and pre.default=1
		LEFT JOIN articulostock sto ON sto.idarticulo=pro.id and idalmacen=:idalmacen
		LEFT JOIN grupo_de_productos gpo ON gpo.id= sto.idgrupo
		WHERE pro.codigo like :codigo
		LIMIT :start,:limit';
		
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$sth->bindValue(':start',$start, PDO::PARAM_INT);
		$sth->bindValue(':limit',$pageSize, PDO::PARAM_INT);
		$sth->bindValue(':idalmacen',$idalmacen, PDO::PARAM_INT);
		$sth->bindValue(':codigo','%'.$codigo.'%', PDO::PARAM_STR);
		
		$exito=$sth->execute();
		if ( !$exito) return $this->getError($sth);
		
		$datos =$sth->fetchAll( PDO::FETCH_ASSOC );
		return array(
			'totalRows'=>$total,
			'rows'=>$datos
		);
	}
	
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
		
		$con = $this->getConexion();
		
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla;
		$sth = $con->query($sql); // Simple, but has several drawbacks		
		$tot = $sth->fetchAll(PDO::FETCH_ASSOC);
		$total = $tot[0]['total'];
		
		$paginar=false;
		if ( isset($params['limit']) && isset($params['start']) ){
			$paginar=true;
		}
		if ($paginar){
			$limit=$params['limit'];
			$start=$params['start'];		
			$sql = 'SELECT p.id,p.nombre,p.codigo,pt.nombre tipo FROM '.$this->tabla.' p
			LEFT JOIN producto_tipo pt ON pt.id = p.tipo
			limit :start,:limit';
		}else{			
			$sql = 'SELECT p.id,p.nombre,p.codigo,pt.nombre tipo FROM '.$this->tabla.' p
			LEFT JOIN producto_tipo pt ON pt.id = p.tipo';
		}
		
		
		$sth = $con->prepare($sql);
		if ($paginar){
			$sth->bindValue(':limit',$limit,PDO::PARAM_INT);
			$sth->bindValue(':start',$start,PDO::PARAM_INT);
		}
		
		$exito = $sth->execute();

		$modelos = $sth->fetchAll(PDO::FETCH_ASSOC);				
		if ( !$exito ){
			throw new Exception("Error listando: ".$sql); //TODO: agregar numero de error, crear una exception MiEscepcion
		}
							
		return array(
			'success'=>true,
			'total'=>$total,
			'datos'=>$modelos
		);
	}
}
?>