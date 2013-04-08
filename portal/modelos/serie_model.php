<?php
class SerieModel extends Modelo{
	var $tabla='series';
	function getSeries($start,$pageSize, $idalmacen){
		$sql='select COUNT(tab.id) as total FROM '.$this->tabla.' tab WHERE tab.idalmacen=:idalmacen AND tab.folio_f>=tab.sig_folio';
		$model=$this;
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$sth->bindValue(':idalmacen',$idalmacen, PDO::PARAM_INT);		
		
		$datos=$model->execute($sth);		
		if ( !$datos['success'] )return $datos;
		
		$total=$datos['datos'][0]['total'];
		
		$sql='select id, serie, es_default, sig_folio  FROM '.$this->tabla.' WHERE idalmacen=:idalmacen AND folio_f >= sig_folio LIMIT :start,:limit';
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$sth->bindValue(':start',$start, PDO::PARAM_INT);
		$sth->bindValue(':limit',$pageSize, PDO::PARAM_INT);
		$sth->bindValue(':idalmacen',$idalmacen, PDO::PARAM_INT);
		
		$datos=$model->execute($sth);
		if ( !$datos['success'] )return $datos;
		
		return array(
			'success'=>true,
			'total'=>$total,
			'datos'=>$datos['datos']
		);
	}
}
?>