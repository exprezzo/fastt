<?php
function crear_modelo($nombreModelo, $tabla){
	$ruta='..//apps/fastorder/modelos/';	
$contenido='<?php
class '.$nombreModelo.'Modelo extends Modelo{
	var $tabla="'.$tabla.'";
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
		return parent::paginar($params);
	}
}
?>';
	
	
	$rutaCompleta=$ruta.$nombreModelo.'_modelo.php';
	
	if ( file_exists($rutaCompleta) ){
		echo 'El archivo '.$rutaCompleta.' ya existe;<br/> ';
	}else{
		file_put_contents($rutaCompleta, $contenido);
		if ( file_exists($rutaCompleta) ){
			echo 'archivo creado: '.$rutaCompleta.' ;<br/> ';
		}else{
			echo 'el archivo no pudo crearse: '.$rutaCompleta.'<br/> ';
		}
		
	}
	
}
?>