<?php
class RecetaModelo extends Modelo{
	var $tabla="articulo_detalle";
	var $campos=array('id','idarticulo','fk_articulo','cantidad');
	
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
			$sql = 'SELECT d.id, d.idarticulo, r.nombre as receta,i.nombre ingrediente, d.fk_articulo,d.cantidad FROM '.$this->tabla.' d
			LEFT JOIN productos r ON r.id = d.idarticulo 
			LEFT JOIN productos i ON i.id = d.fk_articulo 
			limit :start,:limit';
		}else{			
			$sql = 'SELECT * FROM '.$this->tabla.' ';
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