<?php
class General extends Controlador{
	function index($vistaFile=''){				
		$vista= $this->getVista();					
		return $vista->mostrar( '/index' );
	}
}
?>