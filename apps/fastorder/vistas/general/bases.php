<?php
for($i=1; $i<28; $i++){
	$sql='insert into articulopre SET idarticulo='.$i.', descripcion=desc_'.$i.' factor=1, ultimocosto=0, default=1'; 
	$mod=new Modelo();
	$con=$mod->getPdo();
	$sth = $con->prepare($sql);
	$sth->bindValue(':existencia',$detalle['existencia'],PDO::PARAM_INT);
	$sth->bindValue(':idarticulo',$detalle['fk_articulo'],PDO::PARAM_INT);
	$sth->bindValue(':idalmacen',$idalmacen,PDO::PARAM_INT);
	$exito = $sth->execute();
	if (!$exito) return $this->getError($sth);
}

?>