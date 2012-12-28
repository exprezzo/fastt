<?php
require_once 'peticion.php';
require_once 'controlador/controlador.php';
require_once 'vista/vista.php';
class Despachador{
	var $_peticion;
	
	function despacharPeticion($peticion=null){
		global $_PETICION;		
						
		$msgExito = 'petición servida con éxito';
		$msgFalla = 'La petición no puede servirse';
		
		
		$accion=$_PETICION->accion;
		
		$ejecutar=false;
		
		//Dependiendo del analisis de la peticion, el sistema tratara de responder a la peticion con una de las siguientes maneras.
		
		// 1.- Cargar una vista.
		// 2.- Ejecutar una accion de un controlador.
		// 3.- Ejecutar una accion de un controlador de modulo.
		
		if ( empty($_PETICION->controlador) ){
			$controller = new Controlador();
			$respuesta = $controller->mostrarVista();
		}else{
			if ( file_exists(PATH_CONTROLADORES.$_PETICION->controlador.'.php') ){			
				$controller=new $_PETICION->controlador;		
				
				//  Aqui se decide entre ejecutar accion o cargar vista
				if (method_exists($controller, $accion)){				
					$respuesta = $controller->$accion();				
					if ($respuesta==null){
						$respuesta=array(
							'success'=>true
						);
					}
				}else{		
					$respuesta = $controller->mostrarVista();
					//$respuesta = $controller->procesarPeticion($_PETICION);											
				}	
			}else{
				$respuesta=array(
					'success'=>false,
					'msg'=>'El controlador '.$_PETICION->controlador.' no existe',
				);				
				header("HTTP/1.0 404 Not Found".'El controlador '.$_PETICION->controlador.' no existe');
			}
		}
		
		//------------------------------------
		if ( $respuesta['success'] == true ){
			$respuesta['msg'] = $msgExito;
		}else{
			if ($respuesta['msg'] == null )
				$respuesta['msg'] = $msgFalla;
		}
		return $respuesta;						
	}
	
}
?>