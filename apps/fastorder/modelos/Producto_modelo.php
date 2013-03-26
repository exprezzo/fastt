<?php
class ProductoModelo extends Modelo{
	var $tabla="productos";
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
		return $this->paginar($params);
	}
	
	function paginar($params){
		$con = $this->getConexion();
		
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla;
		$sth = $con->query($sql); // Simple, but has several drawbacks		
		$tot = $sth->fetchAll(PDO::FETCH_ASSOC);
		$total = $tot[0]['total'];
		
		$limit=$params['limit'];
		$start=$params['start'];		
		$sql = 'SELECT p.id,p.nombre,p.codigo, pt.nombre tipo FROM '.$this->tabla.' p
		LEFT JOIN producto_tipo pt ON pt.id = p.tipo
		limit :start,:limit';
		// echo $sql;
		$sth = $con->prepare($sql);
		$sth->bindValue(':limit',$limit,PDO::PARAM_INT);
		$sth->bindValue(':start',$start,PDO::PARAM_INT);
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