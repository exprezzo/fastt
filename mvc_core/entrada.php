<?php
	//  AQUI INICIA EL PROCESO
	session_start();
	require_once '../config.php';		
	require_once 'despachador.php';		
	
	$despachador = new Despachador();
	
	try{
		/*
		$despachador->getPeticion() es SINGLETON (o deberia serlo)
		*/
		
		$_PETICION=new Peticion();
				
		//El controlador default u otro creado para el sistema
		if ( file_exists(PATH_CONTROLADORES.$_PETICION->controlador.'.php') ){
			require_once (PATH_CONTROLADORES.$_PETICION->controlador.'.php');
		}
		
		$result=$despachador->despacharPeticion($_PETICION);
		
		if ( $result['success']==false ) {
			echo $result['msg'];
			//$vista= new Vista('asd');
			//$vista->mostrar('asd');
			
			
			//PENDIENTE: registrar el error   -------
		}
	}catch(Exception $e){
		//echo 'Ups. <br>';
		echo $e->getMessage();
		//echo "El sistema ha sufrido un fallo, consulte con el administrador del sistema";
		//PENDIENTE: registrar la exception   -------		
	}
?>
