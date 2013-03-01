<?php
require_once '../apps/'.$_PETICION->modulo.'/modelos/articulo_model.php';
class Articulos extends Controlador{
	function index(){
		
		$mod=new ArticuloModel();				
		$start=0;		
		$idalmacen=empty($_REQUEST['idalmacen'] )? 1 :$_REQUEST['idalmacen'];
		$res=$mod->paginar($start,90, $idalmacen);				
		
		echo json_encode($res);			
	}
}
?>