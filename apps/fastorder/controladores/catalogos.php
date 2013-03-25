<?php

require_once '../apps/'.$_PETICION->modulo.'/modelos/Catalogo_modelo.php';

include '../exps/crear_controlador.php';
include '../exps/crear_modelo.php';
include '../exps/crear_vistas.php';
include '../exps/crear_buscador.php';
include '../exps/crear_buscadorjs.php';
include '../exps/crear_editor.php';
include '../exps/crear_editorjs.php';


class catalogos extends Controlador{
	var $modelo="Catalogo";
	
	function nuevo(){		
		$obj=array(
			'id'=>0,
			'nombre'=>'Nombre',
			'controlador'=>'Controlador',
			'modelo'=>'Modelo',
			'tabla'=>'Tabla'
		);
		$vista=$this->getVista();				
		$vista->datos=$obj;		
		
		global $_PETICION;
		$vista->mostrar('/'.$_PETICION->controlador.'/edicion');
		
		
	}
	
	function crear_catalogo($controlador, $modelo, $tabla){
		echo 'crear catalogo, controlador: '.$controlador.' tabla: '.$tabla.'<br/> ';
		$sql="SHOW COLUMNS FROM $tabla";
		$mod=$this->getModel();
		$res=$mod->ejecutarSql($sql);
		// print_r($res);
		$fields=array();
		foreach($res['datos'] as $key=>$value ){		
			$fields[]=$value['Field'];
		}
		// print_r($fields);
		//en la carpeta controladores crea el controlador
		ob_start();
		$resp1=crear_controlador($controlador, $modelo,$fields);
		$resp2=crear_modelo($modelo, $tabla);
		$resp3=crear_buscador($controlador, $modelo);
		$resp4=crear_buscadorjs($controlador, $modelo);
		$resp5=crear_editor($controlador, $modelo);
		$resp6=crear_editorjs($controlador, $modelo);		
		ob_end_clean();
		echo $resp1.$resp2.$resp3.$resp4.$resp5.$resp6;
	}
	function guardar(){
		ob_start();
			$resp = parent::guardar();
		ob_end_clean();
		
		$this->crear_catalogo($_REQUEST['datos']['controlador'], $_REQUEST['datos']['modelo'], $_REQUEST['datos']['tabla']);
		
		return true;
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
?>