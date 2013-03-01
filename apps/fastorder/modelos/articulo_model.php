<?php
class ArticuloModel extends Modelo{
	function buscarPorCodigo(){
	
	}
	function paginar($start=0, $pageSize=9, $idalmacen=0, $codigo=''){
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
	
}
?>