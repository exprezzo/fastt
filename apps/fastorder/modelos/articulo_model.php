<?php
class ArticuloModel extends Modelo{
	
	function paginar($start=0, $pageSize=9){
		$sql='select COUNT(id) as total FROM productos';
		$model=$this;
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$datos=$model->execute($sth);
		
		$total=$datos['datos'][0]['total'];
		
		$sql='select pro.id, pro.nombre,pro.codigo, pre.idarticulopre, pre.descripcion presentacion FROM productos pro
		LEFT JOIN articulopre pre ON pre.idarticulo=pro.id and pre.default=1
		LIMIT :start,:limit';
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