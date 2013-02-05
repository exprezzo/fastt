<?php
class SerieModel extends Modelo{
	var $tabla='series';
	function getSeries($start,$pageSize, $idalmacen){
		$sql='select COUNT(tab.id) as total FROM '.$this->tabla.' tab WHERE tab.idalmacen=:idalmacen';
		$model=$this;
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$sth->bindValue(':idalmacen',$idalmacen, PDO::PARAM_INT);		
		
		$datos=$model->execute($sth);
		
		$total=$datos['datos'][0]['total'];
		
		$sql='select id, serie, es_default,sig_folio  FROM '.$this->tabla.' WHERE idalmacen=:idalmacen LIMIT :start,:limit';
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$sth->bindValue(':start',$start, PDO::PARAM_INT);
		$sth->bindValue(':limit',$pageSize, PDO::PARAM_INT);
		$sth->bindValue(':idalmacen',$idalmacen, PDO::PARAM_INT);
		
		$datos=$model->execute($sth);
		
		return array(
			'total'=>$total,
			'datos'=>$datos['datos']
		);
	}
}
?>