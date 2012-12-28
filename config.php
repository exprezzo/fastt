<?php
$APP_URL='http://'.$_SERVER['SERVER_NAME']; 
// 		BDD  
$DB_CONFIG=array(
	'DB_SERVER'	=>'localhost',
	'DB_NAME'	=>'fastt',
	'DB_USER'	=>'root',
	'DB_PASS'	=>''
);

//		USER WIDGET  
$FB_CONFIG=array(
	'FB_APP_ID' 			=> '',
	'FB_APP_SECRET' 		=> '',
	'FB_MY_URL' 			=> $APP_URL.'/auth/fblogin',
	'FB_LOGOUT_ABSOLUTE' 	=> $APP_URL.'/auth/logout'
);

// 		NUCLEO DEL MVC  
define ("PATH_MVC",'../app/');
define ("VISTAS_PATH",		 PATH_MVC.'vistas/');
define ("PATH_CONTROLADORES",PATH_MVC.'controladores/');

define ("PATH_NUCLEO",'../mvc_core/');
?>