<?php
require_once '../'.$_PETICION->modulo.'/modelos/catalogo_modelo.php';

class General extends Controlador{
	function index($vistaFile=''){						
		$vista= $this->getVista();					
		
		$catMod = new CatalogoModelo();		
		
		$params=array(
			'start'=>0,
			'limit'=>1000
		);
		$res=$catMod->buscar( $params );		
		$vista->catalogos=$res['datos'];
		
		return $vista->mostrar( '/index' );
	}
}
?>