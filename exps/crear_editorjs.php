<?php
function crear_editorjs($nombreControlador, $nombreModelo){
	$ruta='..//web/apps/fastorder/js/catalogos/'.$nombreControlador.'/';	
	
	
	ob_start();
	include 'edicion.js';	
	
	$out1 = ob_get_contents();
	
	
	
	
	
	
	$contenido=str_replace ('EdicionNombreDelControlador','Edicion'.$nombreControlador,$out1);
	
	$rutaCompleta=$ruta.'edicion.js';	
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