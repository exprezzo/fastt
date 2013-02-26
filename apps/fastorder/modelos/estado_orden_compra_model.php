<?php
class EstadoOrdenCompraModel extends Modelo{
	var $tabla='estado_orden_compra';
	function paginar($start=0, $pageSize=9){
		$sql='select COUNT(ped.id) as total FROM '.$this->tabla.' ped';
		$model=$this;
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$datos=$model->execute($sth);
		
		$total=$datos['datos'][0]['total'];
		
		$sql='select id , nombre  FROM '.$this->tabla.' LIMIT :start,:limit';
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$sth->bindValue(':start',$start, PDO::PARAM_INT);
		$sth->bindValue(':limit',$pageSize, PDO::PARAM_INT);
		$datos=$model->execute($sth);
		
		return array(
			'total'=>$total,
			'datos'=>$datos['datos']
		);
	}	
}
?>