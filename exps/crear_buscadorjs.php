<?php
function crear_buscadorjs($nombreControlador, $nombreModelo){
	$ruta='..//web/apps/fastorder/js/catalogos/'.$nombreControlador.'/';	
	
	mkdir($ruta, 0700);
	ob_start();
	include 'busqueda.js';	
	
	$out1 = ob_get_contents();
	
	
	
	
	
	
	$contenido=str_replace ('BusquedaNombreDelControlador','Busqueda'.$nombreControlador,$out1);
	
	$rutaCompleta=$ruta.'busqueda.js';	
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