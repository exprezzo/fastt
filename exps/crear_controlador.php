<?php
function crear_controlador($nombreControlador, $nombreModelo){
	$ruta='..//apps/fastorder/controladores/';	
$contenido='<?php

require_once \'../apps/\'.$_PETICION->modulo.\'/modelos/'.$nombreModelo.'_modelo.php\';
class '.$nombreControlador.' extends Controlador{
	var $modelo="'.$nombreModelo.'";
	
	// function nuevo(){
		// return parent::nuevo();
	// }
	
	function guardar(){
		return parent::guardar();
	}
	function borrar(){
		return parent::borrar();
	}
	function editar(){
		return parent::editar();
	}
	function buscar(){
		return parent::buscar();
	}
}
?>';
	
	
	$rutaCompleta=$ruta.$nombreControlador.'.php';
	
	if ( file_exists($rutaCompleta) ){
		echo 'Ek archivo '.$rutaCompleta.' ya existe;<br/> ';
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