<?php
function crear_controlador($nombreControlador, $nombreModelo,$fields){
	$ruta='..//apps/fastorder/controladores/';	
	print_r($fields); 
	
	$fieldsStr='array(';
	for($i=0; $i<sizeof($fields); $i++ ){
		$fieldsStr.='\''.$fields[$i].'\',';
	}
	
	$fieldsStr=$sql=substr($fieldsStr, 0, strlen($fieldsStr)-1 );
	$fieldsStr.=')';
	
$contenido='<?php
require_once \'../apps/\'.$_PETICION->modulo.\'/modelos/'.$nombreModelo.'_modelo.php\';
class '.$nombreControlador.' extends Controlador{
	var $modelo="'.$nombreModelo.'";
	
	function nuevo(){		
		$fields='.$fieldsStr.';
		$vista=$this->getVista();				
		for($i=0; $i<sizeof($fields); $i++){
			$obj[$fields[$i]]=\'\';
		}
		$vista->datos=$obj;		
		
		global $_PETICION;
		$vista->mostrar(\'/\'.$_PETICION->controlador.\'/edicion\');
		
		
	}
	
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