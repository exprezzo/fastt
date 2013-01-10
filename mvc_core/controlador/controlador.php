<?php

require '../mvc_core/modelo/Modelo_PDO.php';
class Controlador{
	
	function __construct(){				
	}
	
	function mostrarVista($vistaFile=''){		
		$vista= $this->getVista();					
		global $_PETICION;
		
		$archivoVista='';
		if ( empty($vistaFile) ){									
			if ( !empty($_PETICION->controlador) ){			
				$archivoVista = $_PETICION->controlador.'/'.$_PETICION->accion;				
			}else{
				$archivoVista =  $_PETICION->accion;
			}
		}else{
			$archivoVista = $vistaFile;
		}
		
		return $vista->mostrar( $archivoVista );
	}
	
	function getVista(){
		if ( !isset($this->vistaObj) ){
			require_once PATH_NUCLEO.'vista/vista.php';
			$this->vistaObj = new Vista();
		}
		return $this->vistaObj;
	}
	
	function mostrarErrores($errores){
		$vista		= $this->getVista();
		$vista->errores	= $errores;
		return $this->mostrarVista();
	}			
	
	function mostrarError($errores){
		return $this->mostrarErrores($errores);		
	}
			
	function procesarPeticion($peticion){
		$vista= $this->getVista();		
		//$vista->plantillaContenido=$peticion->accion;							
		return $vista->mostrar($peticion->accion);		
	}	
	
	function getModel(){		
		if ( !isset($this->modObj) ){						
			$this->modObj = new Modelo_PDO();	
		}	
		return $this->modObj;
	}	
	
	/* CRUD */
	function obtener(){
		$modObj= $this->getModel();
		
		$params=$this->bindParams();
		$res = $modObj->obtener( $params );
		
		$success=true;
		$respuesta= array(
			'success'=>$success,
			'data'=>$res,
			'msg'=>'Información recibida'
		);
		echo json_encode($respuesta);
		return $respuesta;		
	}	
	
	private function getFindParams(){
		$limit=(empty($_REQUEST['limit']))?100 : $_REQUEST['limit'];
		$start=(empty($_REQUEST['start']))?0 : $_REQUEST['start'];
		$query=(empty($_REQUEST['query']))? "" : $_REQUEST['query'];
		$params=array(
			'limit'=>$limit,
			'start'=>$start,
			'query'=>$query
		);		
		return $params;
	}
	
	/*
	function paginar(){
		$modObj= $this->getModel();
		
		$params=$this->getFindParams();		
		
		$res = $modObj->listar( $params );				
		echo json_encode($res);
		return $res;		
	}*/
	
	function guardar(){
		$modObj= $this->getModel();		
		$params = $this->bindParams();
		
		$res = $modObj->guardar( $params );		

		$success=true;
		$respuesta= array(
			'success'=>$success,
			'data'=> $res
		);
		
		$respuesta=$this->despuesDeGuardar($respuesta);
		
		echo json_encode($respuesta);
		return $respuesta;
	}
	
	function despuesDeGuardar($respuesta){
		return $respuesta;
	}
	
	private function bindParams(){	
		return $_REQUEST;		
	}
	
	function eliminar(){
		$modObj= $this->getModel();
		$params=array();
		
		if ( !isset($_POST['id']) ){
			$id=$_POST['datos'];
		}else{
			$id=$_POST['id'];
		}
		$params['id']=$id;
		
		$res=$modObj->borrar($params);
		$respuesta = array(
			'success'=>$res,
			'msg'=>'Registro Eliminado'
		);
		
		echo json_encode($respuesta);
		
		return $respuesta;
	}
}
?>