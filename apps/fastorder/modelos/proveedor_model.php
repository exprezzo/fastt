<?php
class ProveedorModel extends Modelo{
	
	function paginar($start=0, $pageSize=9){
		$sql='select COUNT(ped.id) as total FROM proveedor ped';
		$model=$this;
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$exito=$sth->execute();
		
		if ( !$exito ) return $this->getError($sth);
		
		$datos=$sth->fetchAll(PDO::FETCH_ASSOC);
		
		$total=$datos[0]['total'];
		
		$sql='select *,id as value, nombre as label, nombre as nombreAlmacen FROM proveedor LIMIT :start,:limit';
		$con=$model->getConexion();
		$sth=$con->prepare($sql);
		$sth->bindValue(':start',$start, PDO::PARAM_INT);
		$sth->bindValue(':limit',$pageSize, PDO::PARAM_INT);
		$datos=$model->execute($sth);
		
		return array(
			'success'=>true,
			'total'=>$total,
			'datos'=>$datos['datos']
		);
	}
	
}
?>